<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Store.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if ($action[1]=="ekle" AND $_POST OR $action[1]=="duzenle" AND $_POST):
	
	if (!empty(post('heading')) && !empty(post('servers')) && !empty(post('price'))):
		
		$data = array(
			'heading' => post('heading'),
			'serverID' => post('servers'),
			'price' => post('price'),
			'color' => post('color'),
			'duration' => post('duration'),
			'discountDuration' => post('discountDuration'),
			'commands' => base64_encode(json_encode($_POST['commands'])),
			'stockStatus' => post('stockStatus')
		);

		if (post('discount')==1):
			
			$data['discount'] = 1;

			if (!empty(post('discountPrice'))):
				
				$data['discountPrice'] = post('discountPrice');

				if (post('discountDuration')==1):
					
					if (!empty(post('discountExpiry'))):
						
						$data['discountExpiry'] = post('discountExpiry');

					endif;

				endif;

			endif;

		else:

			$data['discount'] = 0;

		endif;

		if (post('duration')==1):

			if (!empty(post('durationDay'))):
				
				$data['durationDay'] = post('durationDay');
				$data['expiryCommands'] = base64_encode(json_encode($_POST['expiryCommands']));

			endif;

		endif;

		if (post('stockStatus')==1):
			
			if (empty(post('stock'))):
				
				$data['stock'] = 0;

			else:

				$data['stock'] = post('stock');

			endif;

		endif;

		$servers = $db->from('Servers')->all();

		if ($servers):

			$featuresArray = array();

			foreach ($servers as $key => $readServ):

				$vipFeatures = $db->from('VipFeatures')->where('serverID', $readServ['id'])->all();

				if ($vipFeatures):

					foreach ($vipFeatures as $key => $readFeatures):

						$featuresArray[$readFeatures['slug']] = htmlspecialchars_decode($_POST[$readFeatures['slug']]);

					endforeach;

				endif;

			endforeach;

			$data['content'] = base64_encode(json_encode($featuresArray));

		endif;

		if ($action[1]=="ekle"):
			
			$addVIP = $db->insert('Vips')->set($data);

			if ($addVIP):
				
				$response = alertSuccess('VIP başarıyla eklendi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		elseif ($action[1]=="duzenle"):

			$data['id'] = $action[2];

			$updateVIP = $db->update('Vips')->where('id', $data['id'])->set($data);

			if ($updateVIP):
				
				$response = alertSuccess('VIP başarıyla güncellendi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

	else:

		$response = alertDanger('Lütfen boş alan bırakmayınız.');

	endif;

endif;

if ($action[1]=="liste"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		$deleteVip = $db->delete('Vips')->where('id', $action[3])->done();

		if ($deleteVip):
			
			$response = alertSuccess('VIP başarıyla silindi.');

		else:

			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;

	if ($_POST):

		$totalVips = $db->from('Vips')->join('Servers', 'Servers.id = Vips.serverID')->select('count(*) as total')->like('Vips.heading', post('query'))->total();

		if ($totalVips > 0):
			
			$query = $db->from('Vips')
	                    ->join('Servers', 'Servers.id = Vips.serverID')
	                    ->select('Vips.*, Servers.heading as serverName')
	                    ->like('Vips.heading', post('query'))
	                    ->orderby('Vips.id', 'DESC')
	                    ->all();

		endif;

	else:

		$totalVips = $db->from('Vips')->join('Servers', 'Servers.id = Vips.serverID')->select('count(*) as total')->total();

	    if ($totalVips > 0):

	        $totalPage = ceil($totalVips / "50");

	        $pagination = $db->pagination($totalVips, "50", "limit");

	        $query = $db->from('Vips')
	                    ->join('Servers', 'Servers.id = Vips.serverID')
	                    ->select('Vips.*, Servers.heading as serverName')
	                    ->orderby('Vips.id', 'DESC')
	                    ->limit($pagination['start'], $pagination['limit'])
	                    ->all();

	        if (!isset($_GET['limit'])):
	    
	            $_GET['limit'] = "1";
	        
	        endif;
	        
	        $prevPage = $_GET['limit'] - 1;
	        
	        $nextPage = $_GET['limit'] + 1;

	    endif;

	endif;

elseif ($action[1]=="ekle" OR $action[1]=="duzenle"):

	$extraResourcesCSS = new ExtraResources('css');
	$extraResourcesCSS->addResource('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');
	
	$extraResourcesJS = new ExtraResources('js');
	$extraResourcesJS->addResource('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');
	$extraResourcesJS->addResource('assets/js/pages/store.js');
	
	$extraResourcesScript = new ExtraResources('script');
	$extraResourcesScript->addResource('$(\'[data-toggle="color-picker"]\').colorpicker({format:"hex"});');

	if ($action[1]=="ekle"):
	
		$servers = $db->from('Servers')->all();

	elseif ($action[1]=="duzenle"):

		$query = $db->from('Vips')->where('id', $action[2])->first();

		$servers = $db->from('Servers')->all();

		if ($servers):
				
			$features = $db->from('VipFeatures')->where('serverID', $query['serverID'])->all();

		endif;

	endif;

elseif ($action[1]=="ozellik"):

	if($_POST && $action[2]=="duzenle" OR $_POST && $action[2]=="ekle"):

		if (!empty(post('heading'))):

		    $slug = convertURL(post('heading'));

		    $query = $db->from('VipFeatures')->where('serverID', post('serverID'))->where('slug', $slug)->select('count(id) as total')->total();

		    if($query > 0):

		        $slug = $slug."_".rand(1, 9999);

		    endif;

		    $data = array(
		        'heading' => post('heading'),
		        'serverID' => post('serverID'),
		        'slug' => $slug
		    );

		    if ($action[2]=="ekle"):

		    	$data['creationDate'] = date('Y-m-d H:i:s');
				$data['updateDate'] = date('Y-m-d H:i:s');

		        $addFeatures = $db->insert('VipFeatures')->set($data);

		        if ($addFeatures):

		            $response = alertSuccess('Özellik başarıyla eklendi.');

		        else:

		            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		        endif;

		    elseif($action[2]=="duzenle"):

		    	$data['updateDate'] = date('Y-m-d H:i:s');

		        $query = $db->from('VipFeatures')->where('id', $action[3])->first();

		        if($query['heading'] == post('heading')):

		            $data['slug'] = $query['slug'];

		        endif;

		        $data['id'] = $action[3];

		        $editFeatures = $db->update('VipFeatures')->where('id', $data['id'])->set($data);

		        if ($editFeatures):

		            $response = alertSuccess('Özellik başarıyla güncellendi.');

		        else:

		            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		        endif;

		    endif;

		else:

		    $response = alertDanger('Lütfen boş alan bırakmayınız');

		endif;

	endif;
	
	if ($action[2]=="ekle"):
		
		$servers = $db->from('Servers')->all();

	elseif($action[2]=="duzenle"):

		$query = $db->from('VipFeatures')->where('id', $action[3])->first();

		$servers = $db->from('Servers')->all();

	elseif ($action[2]=="liste"):

		if (isset($action[3]) && $action[3]=="sil"):
		
			$deleteVipFeatures = $db->delete('VipFeatures')->where('id', $action[4])->done();

			if ($deleteVipFeatures):
				
				$response = alertSuccess('Özellik başarıyla silindi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

		if ($_POST):

			$totalFeatures = $db->from('VipFeatures')->join('Servers', 'Servers.id = VipFeatures.serverID')->like('VipFeatures.heading', post('query'))->select('count(*) as total')->total();

			if ($totalFeatures > 0):

				$query = $db->from('VipFeatures')->like('heading', post('query'))->all();

			endif;

		else:

			$totalFeatures = $db->from('VipFeatures')->join('Servers', 'Servers.id = VipFeatures.serverID')->select('count(*) as total')->total();

			if ($totalFeatures > 0):

			    $totalPage = ceil($totalFeatures / "50");

			    $pagination = $db->pagination($totalFeatures, "50", "limit");

			    $query = $db->from('VipFeatures')
	                ->join('Servers', 'Servers.id = VipFeatures.serverID')
	                ->select('VipFeatures.*, Servers.heading as serverName')
	                ->orderby('VipFeatures.id', 'desc')
	                ->limit($pagination['start'], $pagination['limit'])
	                ->all();

			    if (!isset($_GET['limit'])):
			
			        $_GET['limit'] = "1";
			    
			    endif;
			    
			    $prevPage = $_GET['limit'] - 1;
			    
			    $nextPage = $_GET['limit'] + 1;

			endif;

		endif;

	endif;


endif;

require realpath('.') . '/view/vip.php';