<?php

if ($readTheme['slider']==1):

    $sliderTotal = $db->from('Slider')->select('count(*) as total')->total();

    if ($sliderTotal > 0):

        $externalJS = array('/'.$realPath.'assets/js/pages/index.js');

    	$slider = $db->from('Slider')->orderby('id', 'DESC')->all();

	endif;

endif;

$newsTotal = $db->from('News')->join('NewsCategory', 'NewsCategory.id = News.category')->join('Users', 'Users.id = News.accID')->select('count(*) as total')->total();

if ($newsTotal > 0):

    $pageParam = 'haberler';

    $totalPage = ceil($newsTotal / $readSettings['newsLimit']);

    $pageLimit = $readSettings['newsLimit'];

    $pagination = $db->pagination($newsTotal, $pageLimit, $pageParam);

    $news = $db->from('News')
        ->join('NewsCategory', 'NewsCategory.id = News.category')
        ->join('Users', 'Users.id = News.accID')
        ->select('News.*, NewsCategory.heading as CategoryHeading, NewsCategory.color as CategoryColor')
        ->limit($pagination['start'], $pagination['limit'])
        ->orderBy('News.id', 'DESC')
        ->all();
    
    if (!isset($_GET[$pageParam])):
    
        $_GET[$pageParam] = "1";
    
    endif;
    
    $prevPage = $_GET[$pageParam] - 1;
    
    $nextPage = $_GET[$pageParam] + 1;

endif;

require $realPath . '/view/index.php';