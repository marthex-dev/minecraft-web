<?php

if (!isset($readAdmin) OR isset($readAdmin) && $readAdmin['permission'] == "1" OR isset($readAdmin) && $readAdmin['permission'] == "0"):

    header('Location:' . site_url() . '/giris-yap');
    exit;

endif;

require realpath('.') . '/classes/Slider.class.php';
require realpath('.') . '/classes/ExtraResources.class.php';

if($_POST && $action[1] == "ekle" OR $_POST && $action[1] == "duzenle"):

	require realpath('.') . '/classes/Upload.class.php';

    if (!empty($_POST['type']) && !empty($_POST['heading'])):

        $data = array(
            'type' => post('type'),
            'heading' => post('heading'),
            'link' => post('link'),
            'content' => htmlspecialchars_decode(post('content'))
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
                if(post('type')==1):
                $upload->image_x = 1000;
                $upload->image_y = 620;
                else:
                $upload->image_x = 1920;
                $upload->image_y = 595;
                endif;
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

            $addSlider = slider::addSlider($data);

            if ($addSlider):

                $response = alertSuccess('Slider başarıyla eklendi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        elseif($action[1]=="duzenle"):

            $data['updateDate'] = date('Y-m-d H:i:s');

            $data['id'] = $action[2];

            $editSlider = slider::editSlider($data, $imageStatus);

            if ($editSlider):

                $response = alertSuccess('Slider başarıyla güncellendi.');

            else:

                $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

            endif;

        endif;

    else:

        $response = alertDanger('Lütfen boş alan bırakmayınız.');

    endif;

endif;

if ($action[1]=="liste"):

    if (isset($action[2]) AND $action['2']=="sil"):

        $deleteSlider = slider::deleteSlider($action[3]);

        if ($deleteSlider):

            $response = alertSuccess('Slider başarıyla silindi');

        else:

            $response = alertDanger('Hata! Yetkiliyle iletişime geçiniz.');

        endif;

    endif;

    if ($_POST):
        
        $query = $db->from('Slider')->like('heading', post('query'))->orderby('id', 'desc')->all();

    else:

        $query = $db->from('Slider')->orderby('id', 'desc')->all();

    endif;

endif;

if($action[1]=="duzenle" OR $action[1]=="ekle"):

	$extraResourcesCSS = new ExtraResources('css');
    $extraResourcesCSS->addResource('assets/libs/summernote/summernote-bs4.min.css');
    
    $extraResourcesJS = new ExtraResources('js');
    $extraResourcesJS->addResource('assets/libs/summernote/summernote-bs4.min.js');

	$extraResourcesScript = new ExtraResources('script');
    $extraResourcesScript->addResource('
    $(function() {

    	$("[data-toggle=\'quill\']").summernote({height:175,minHeight:null,maxHeight:null});

    	if($(\'#sliderType\').val() == \'1\') {
    		$(\'#sliderContent\').fadeIn(600);
    	} else {
    		$(\'#sliderContent\').hide();
    	}

    	$(\'#sliderType\').change(function(){
    		if($(\'#sliderType\').val() == \'1\') {
    			$(\'#sliderContent\').fadeIn(600);
    		} else {
    			$(\'#sliderContent\').hide();
    		}

        });
    });');

	if ($action[1]=="duzenle"):
		
		$readSlider = $db->from('Slider')->where('id', $action[2])->first();

	endif;

endif;

require realpath('.') . '/view/slider.php';