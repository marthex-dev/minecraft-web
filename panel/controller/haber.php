<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/News.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if ($action[1]=="liste"):

	if(isset($action[2])=="sil"):

		$deleteNews = news::deleteNews($action[3]);

		if ($deleteNews):
			
			$response = alertSuccess('Haber başarıyla silindi.');
					
		else:

			$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

		endif;

	endif;

	if ($_POST):
		
		$query = news::getNews(post('query'));

	else:

		$totalNews = $db->from('News')->join('NewsCategory', 'NewsCategory.id = News.category')->join('Users', 'Users.id = News.accID')->select('count(*) as total')->total();

        if ($totalNews > 0):

            $totalPage = ceil($totalNews / "50");

            $pagination = $db->pagination($totalNews, "50", "limit");

            $query = $db->from('News')
                        ->join('NewsCategory', 'NewsCategory.id = News.category')
                        ->join('Users', 'Users.id = News.accID')
                        ->select('News.heading as newsHeading, Users.id as UserID, NewsCategory.heading as categoryHeading, Users.username as username, News.id as id, News.views as views, News.commentsStatus as commentsStatus, News.creationDate as creationDate, News.slug')
                        ->limit($pagination['start'], $pagination['limit'])
                        ->orderby('News.id', 'desc')
                        ->all();

            if (!isset($_GET['limit'])):
    
                $_GET['limit'] = "1";
            
            endif;
            
            $prevPage = $_GET['limit'] - 1;
            
            $nextPage = $_GET['limit'] + 1;

        endif;

	endif;

elseif($action[1]=="ekle" OR $action[1]=="duzenle"):

	$extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    $extraResourcesCSS->addResource('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');
    $extraResourcesJS->addResource('assets/libs/bootstrap-tagsinput/bootstrap-tagsinput.js');
    
    $extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null}); $("[data-toggle=\'tagsinput\']").tagsinput();');

	if ($_POST):

		require realpath('.') . '/classes/Upload.class.php';

		if(!empty(post('heading')) && !empty(post('newsCategory')) && !empty(post('content')) && !empty(post('newsTags')) && !empty(post('newsComments'))):

			$slug = convertURL(post('heading'));

			$query = $db->from('News')->where('slug', $slug)->select('count(id) as total')->total();

			if($query > 0):

				$slug = $slug."-".rand(1, 9999);

			endif;

			$data = array(
				'heading' => post('heading'),
				'category' => post('newsCategory'),
				'content' => htmlspecialchars_decode(post('content')), 
				'tags' => post('newsTags'),
				'commentsStatus' => post('newsComments'),
				'slug' => $slug
			);

			$imageStatus = "0";

			if ($_FILES["image"] != null):

				$upload = new Upload($_FILES["image"], "tr_TR");
				$image = md5(uniqid(rand(0, 9999)));
				if ($upload->uploaded):

					$upload->allowed = array("image/*");
					$upload->file_new_name_body = $image;
					$upload->image_resize = true;
					$upload->image_ratio_crop = true;
					$upload->image_x = 640;
					$upload->image_y = 360;
					$upload->Process($find_read_panel);

                	if ($upload->processed):

                    	$image = $image.".".$upload->file_dst_name_ext;

						$data['image'] = $image;

						$imageStatus = "1";

					else:

						$response = alertDanger('Hata! '.$upload->error);

					endif;

				else:

					$response = alertDanger('Hata! '.$upload->error);

				endif;

			endif;

			if ($action[1]=="ekle"):

				$data['creationDate'] = date('Y-m-d H:i:s');
				$data['updateDate'] = date('Y-m-d H:i:s');

				$data['accID'] = $readAdmin['id'];

				$addNews = news::addNews($data);

				if ($addNews):

					$response = alertSuccess('Haber başarıyla eklendi.');
				
				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			elseif($action[1]=="duzenle"):

				$data['updateDate'] = date('Y-m-d H:i:s');

                $query = $db->from('News')->where('id', $action[2])->first();

			    if($query['heading'] == post('heading')):

                    $data['slug'] = $query['slug'];

                endif;

				$data['id'] = $action[2];

				$editNews = news::editNews($data, $imageStatus);

				if ($editNews):

					$response = alertSuccess('Haber başarıyla güncellendi.');
				
				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			endif;

		else:

			$response = alertDanger('Lütfen boş alan bırakmayınız.');

		endif;

	endif;

	if ($action[1]=="ekle"):

		$newsCategory = $db->from('NewsCategory')->orderby('id', 'asc')->all();

	elseif($action[1]=="duzenle"):

		$query = $db->from('News')->where('id', $action[2])->first();
		$newsCategory = $db->from('NewsCategory')->orderby('id', 'asc')->all();

	endif;

elseif($action[1]=="kategori"):
	
	if($_POST && $action[2]=="duzenle" OR $_POST && $action[2]=="ekle"):

		if(!empty(post('heading'))):

			if($action[2]=="ekle"):

                $slug = convertURL(post('heading'));

                $query = $db->from('NewsCategory')->where('slug', $slug)->select('count(id) as total')->total();

                if($query > 0):

                    $slug = $slug."-".rand(1, 9999);

                endif;

                $data = array(
                    'slug' => $slug,
                    'heading' => post('heading'),
                    'color' => post('color'),
                    'creationDate' => date('Y-m-d H:i:s'),
                    'updateDate' => date('Y-m-d H:i:s')
                );

				$addCategory = newsCategory::addNewsCategory($data);

				if ($addCategory):

					$response = alertSuccess('Kategori başarıyla eklendi.');
				
				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			elseif($action[2]=="duzenle"):

                $query = $db->from('NewsCategory')->where('id', $action[3])->first();

			    if($query['heading'] == post('heading')):

                    $slug = $query['slug'];

			    else:

                    $slug = convertURL(post('heading'));

                    $query = $db->from('NewsCategory')->where('slug', $slug)->select('count(id) as total')->total();

                    if($query > 0):

                        $slug = $slug."-".rand(1, 9999);

                    endif;

                endif;

                $data = array(
                    'id' => $action[3],
                    'slug' => $slug,
                    'heading' => post('heading'),
                    'color' => post('color'),
                    'updateDate' => date('Y-m-d H:i:s')
                );

				$editCategory = newsCategory::editNewsCategory($data);

				if ($editCategory):
					
					$response = alertSuccess('Kategori başarıyla güncellendi.');
				
				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			endif;

		else:

			$response = alertDanger('Lütfen boş alan bırakmayınız.');

		endif;

	endif;

	if($action[2]=="liste"):
			
		if(isset($action[3]) AND $action[3]=="sil"):

			if ($action[4]):

				$deleteCategory = newsCategory::deleteNewsCategory($action[4]);

				if ($deleteCategory):
					
					$response = alertSuccess('Kategori başarıyla silindi.');
				
				else:

					$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

				endif;

			else:

				$response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

			endif;

		endif;

		if ($_POST):
			
			$query = $db->from('NewsCategory')->like('heading', post('query'))->orderby('id', 'desc')->all();

		else:

			$totalNewsCategory = $db->from('NewsCategory')->select('count(*) as total')->total();

			if (!isset($_GET['limit'])):

			    $_GET['limit'] = "1";
			    
			endif;
			
			$totalPage = 1;
			
			$prevPage = 0;
			
			$nextPage = 1;

			if ($totalNewsCategory > 0):

			    $totalPage = ceil($totalNewsCategory / "50");

			    $pagination = $db->pagination($totalNewsCategory, "50", "limit");

			    $query = $db->from('NewsCategory')->limit($pagination['start'], $pagination['limit'])->orderby('id', 'desc')->all();

			    if (!isset($_GET['limit'])):
			
			        $_GET['limit'] = "1";
			    
			    endif;
			    
			    $prevPage = $_GET['limit'] - 1;
			    
			    $nextPage = $_GET['limit'] + 1;

			endif;

		endif;

	elseif($action[2]=="duzenle" OR $action[2]=="ekle"):

		$extraResourcesCSS = new ExtraResources('css');
		$extraResourcesCSS->addResource('assets/libs/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css');
		
		$extraResourcesJS = new ExtraResources('js');
		$extraResourcesJS->addResource('assets/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js');
		
		$extraResourcesScript = new ExtraResources('script');
		$extraResourcesScript->addResource('$(\'[data-toggle="color-picker"]\').colorpicker({format:"hex"});');

		if ($action[2]=="duzenle"):
			
			$query = $db->from('NewsCategory')->where('id', $action[3])->first();

		endif;

	endif;

elseif($action[1]=="yorumlar"):

	if($action[2]=="liste"):

		$updateNotifications = $db->update('Notifications')->where('status', '1')->where('type', '2')->set(array('status' => '0'));

        if (isset($action[3]) && $action[3]=="durum"):

            $updateComments = newsComments::newsCommentsUpdate($action[4]);

            if($updateComments):

                $response = alertSuccess('Yorum başarıyla güncellendi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        endif;

        if (isset($action[3]) && $action[3]=="sil"):

            $deleteComments = newsComments::newsCommentsDelete($action[4]);

            if($deleteComments):

                $response = alertSuccess('Yorum başarıyla silindi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        endif;


        if ($_POST):
        	
        	$query = $db->from('NewsComments')->join('Users', 'Users.id = NewsComments.accID')->join('News', 'News.id = NewsComments.newsID')->where('NewsComments.message', post('query'), 'LIKE')->or_where('Users.username', post('query'), 'LIKE')->select('NewsComments.message, Users.username, NewsComments.creationDate, NewsComments.status, NewsComments.id, News.slug')->all();

        else:

        	$totalNewsComments = $db->from('NewsComments')->join('Users', 'Users.id = NewsComments.accID')->join('News', 'News.id = NewsComments.newsID')->select('count(*) as total')->total();

			if (!isset($_GET['limit'])):

			    $_GET['limit'] = "1";
			    
			endif;
			
			$totalPage = 1;
			
			$prevPage = 0;
			
			$nextPage = 1;

			if ($totalNewsComments > 0):

			    $totalPage = ceil($totalNewsComments / "50");

			    $pagination = $db->pagination($totalNewsComments, "50", "limit");

			    $query = $db->from('NewsComments')->join('Users', 'Users.id = NewsComments.accID')->join('News', 'News.id = NewsComments.newsID')->select('NewsComments.message, Users.username, NewsComments.creationDate, NewsComments.status, NewsComments.id, News.slug')->limit($pagination['start'], $pagination['limit'])->orderby('NewsComments.id', 'desc')->all();

			    if (!isset($_GET['limit'])):
			
			        $_GET['limit'] = "1";
			    
			    endif;
			    
			    $prevPage = $_GET['limit'] - 1;
			    
			    $nextPage = $_GET['limit'] + 1;

			endif;

        endif;

    else:

    	header('Location: yorumlar/liste');

    endif;

endif;

require realpath('.') . '/view/news.php';