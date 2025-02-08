<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/ExtraResources.class.php';

if ($_POST && $action[1] == "duzenle" OR $_POST && $action[1] == "ekle"):

	if (!empty(post('heading')) && !empty(post('servers'))):

		$data = array(
			'heading' => post('heading'),
			'priceStatus' => post('casePriceStatus'),
			'serverID' => post('servers'),
		);

		$data['slug'] = convertURL(post('heading'));

        $slugCheck = $db->from('Cases')->where('slug', $data['slug'])->select('count(id) as total')->total();

        if($slugCheck > 0):

            $data['slug'] = $data['slug']."-".rand(1, 9999);

        endif;

		if ($data['priceStatus']==1):

			$data['casePrice'] = post('price');
			$data['caseDuration'] = 0;

		else:

			$data['caseDuration'] = post('duration');
			$data['casePrice'] = 0;

		endif;
		
		$caseContent = array();

		$chance = 0;

    	foreach ($_POST['type'] as $key => $readCaseData):

    		array_push($caseContent, array(
    	    	'type' => $_POST['type'][$key],
    	    	'award' => $_POST['award'][$key],
    	    	'chance' => $_POST['chance'][$key],
    	    	'color' => $_POST['color'][$key]
    	    ));

    	    $chance = $chance + $_POST['chance'][$key];

    	endforeach;

    	if ($chance == 100):

    		if ($_FILES["image"] != null):

    			require realpath('.') . '/classes/Upload.class.php';

				$upload = new Upload($_FILES["image"], "tr_TR");
				$image = md5(uniqid(rand(0, 9999)));
				if ($upload->uploaded):

					$upload->allowed = array("image/*");
					$upload->file_new_name_body = $image;
					$upload->image_resize = true;
					$upload->image_ratio_crop = true;
					$upload->image_x = 760;
					$upload->image_y = 660;
					$upload->Process($find_read_panel);

        			if ($upload->processed):

        		    	$image = $image.".".$upload->file_dst_name_ext;

						$data['image'] = $image;

					else:

						$response = alertDanger('Hata! '.$upload->error);

					endif;

				else:

					$response = alertDanger('Hata! '.$upload->error);

				endif;

			endif;

			$data['caseContent'] = base64_encode(json_encode($caseContent));

			if ($action[1]=="ekle"):

				$data['creationDate'] = date('Y-m-d H:i:s');

				$addCase = $db->insert('Cases')->set($data);

				if ($addCase):
					
					$response = alertSuccess('Kasa başarıyla eklendi.');

				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			elseif ($action[1]=="duzenle"):

				$case = $db->from('Cases')->where('id', $action[2])->first();

				if($case['heading'] == post('heading')):

                	$data['slug'] = $case['slug'];

            	endif;

				$updateCase = $db->update('Cases')->where('id', $action[2])->set($data);

				if ($updateCase):
					
					$response = alertSuccess('Kasa başarıyla güncellendi.');

				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			endif;

		else:

			$response = alertDanger('Kazanma şansı toplam 100 olmak zorundadır.');

		endif;

	else:

		$response = alertDanger('Lütfen boş alan bırakmayınız.');

	endif;

endif;

if ($action[1]=="ekle" OR $action[1]=="duzenle"):
	
	$extraResourcesCSS = new ExtraResources('css');
	$extraResourcesCSS->addResource('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');
	
	$extraResourcesJS = new ExtraResources('js');
	$extraResourcesJS->addResource('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');
	$extraResourcesJS->addResource('assets/js/pages/case.js');
	
	$extraResourcesScript = new ExtraResources('script');
	$extraResourcesScript->addResource('$(\'[data-toggle="color-picker"]\').colorpicker({format:"hex"});');
	
	if ($action[1]=="duzenle"):
		
		$readCase = $db->from('Cases')->where('id', $action[2])->first();

	endif;

	$servers = $db->from('Servers')->all();

elseif ($action[1]=="liste"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		$deleteCase = $db->delete('Cases')->where('id', $action[3])->done();

		if ($deleteCase):
			
			$response = alertSuccess('Kasa başarıyla silindi');

		else:

			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;

	if ($_POST):
		
		$totalCase = $db->from('Cases')->where('Cases.heading', post('query'), 'LIKE')->or_where('Servers.heading', post('query'), 'LIKE')->join('Servers', 'Servers.id = Cases.serverID')->select('count(*) as total')->total();

		if ($totalCase > 0):
			
			$cases = $db->from('Cases')
						->join('Servers', 'Servers.id = Cases.serverID')
						->where('Cases.heading', post('query'), 'LIKE')
						->or_where('Servers.heading', post('query'), 'LIKE')
						->select('Cases.*, Servers.heading as serverName')
						->orderby('Cases.id', 'DESC')
						->all();

		endif;

	else:

		$totalCase = $db->from('Cases')->join('Servers', 'Servers.id = Cases.serverID')->select('count(*) as total')->total();

        if ($totalCase > 0):

            $totalPage = ceil($totalCase / "50");

            $pagination = $db->pagination($totalCase, "50", "limit");

            $cases = $db->from('Cases')
						->join('Servers', 'Servers.id = Cases.serverID')
						->select('Cases.*, Servers.heading as serverName')
						->orderby('Cases.id', 'DESC')
						->limit($pagination['start'], $pagination['limit'])
						->all();

            if (!isset($_GET['limit'])):
        
                $_GET['limit'] = "1";
            
            endif;
            
            $prevPage = $_GET['limit'] - 1;
            
            $nextPage = $_GET['limit'] + 1;

        endif;

	endif;

elseif ($action[1]=="gecmis"):

	if (isset($action[2]) && $action[2]=="sil"):
		
		if (isset($action[3])):
			
			$deleteHistory = $db->delete('CasesHistory')->where('id', $action[3])->done();

			if ($deleteHistory):
				
				$response = alertSuccess('Geçmiş başarıyla silindi.');

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

	endif;

	if ($_POST):

		$totalHistory = $db->from('CasesHistory')->join('Cases', 'Cases.id = CasesHistory.caseID')->join('Users', 'Users.id = CasesHistory.accID')->where('Users.username', post('query'), 'LIKE')->or_where('Cases.heading', post('query'), 'LIKE')->select('count(*) as total')->total();

		if ($totalHistory > 0):
			
			$caseHistory = $db->from('CasesHistory')
							  ->join('Cases', 'Cases.id = CasesHistory.caseID')
							  ->join('Users', 'Users.id = CasesHistory.accID')
							  ->where('Users.username', post('query'), 'LIKE')
							  ->or_where('Cases.heading', post('query'), 'LIKE')
							  ->select('Users.username, Cases.heading, CasesHistory.type, CasesHistory.award, CasesHistory.creationDate, CasesHistory.id, Cases.id as cID, CasesHistory.accID')
							  ->orderby('CasesHistory.id', 'DESC')
							  ->all();

		endif;

	else:

		$totalHistory = $db->from('CasesHistory')->join('Cases', 'Cases.id = CasesHistory.caseID')->join('Users', 'Users.id = CasesHistory.accID')->select('count(*) as total')->total();

		$totalPage = 1;
        
        $prevPage = 0;
        
        $nextPage = 1;

		if ($totalHistory > 0):

			$totalPage = ceil($totalHistory / "50");

			$pagination = $db->pagination($totalHistory, "50", "limit");

			$caseHistory = $db->from('CasesHistory')
							  ->join('Cases', 'Cases.id = CasesHistory.caseID')
							  ->join('Users', 'Users.id = CasesHistory.accID')
							  ->select('Users.username, Cases.heading, CasesHistory.type, CasesHistory.award, CasesHistory.creationDate, CasesHistory.id, Cases.id as cID, CasesHistory.accID')
							  ->limit($pagination['start'], $pagination['limit'])
							  ->orderby('CasesHistory.id', 'DESC')
							  ->all();

			if (!isset($_GET['limit'])):
	
			    $_GET['limit'] = "1";
			
			endif;
			
			$prevPage = $_GET['limit'] - 1;
			
			$nextPage = $_GET['limit'] + 1;

		endif;

	endif;

endif;

require realpath('.') . '/view/case.php';