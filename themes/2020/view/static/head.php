<?php

if (isset($readUser['username']) && !isset($_SESSION['username'])):
    
    $_SESSION["username"] = $readUser["username"];
    
endif;

?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="RabiWeb Yazılım Hizmetleri">
    <link rel="shortcut icon" type="image/x-icon" href="<?=$find_read_page.$readSettings['serverFavicon']?>">
    <meta name="description" content="<?=$readSettings['googleDescription']?>">
    <meta name="keywords" content="<?=$readSettings['googleTags']?>">
    <base href="<?=site_url()?>">
    <title><?=$siteTitle?></title>
    <link rel="stylesheet" href="/<?=$realPath?>assets/css/bootstrap.css?v=<?=$RabiwebVersion?>">

    <link rel="stylesheet" href="/<?=$realPath?>assets/css/mdi.css?v=<?=$RabiwebVersion?>">
    <link rel="stylesheet" href="/<?=$realPath?>assets/css/swiper.css?v=<?=$RabiwebVersion?>" />
    <link rel="stylesheet" href="/<?=$realPath?>assets/css/pages/ranks.css?v=<?=$RabiwebVersion?>" />
    <?php if (isset($externalCSS)) : ?>
    
        <?php foreach ($externalCSS as $externalURL) : ?>
            
            <link rel="stylesheet" href="<?=$externalURL?>?v=<?=$RabiwebVersion?>" />
    
        <?php endforeach; ?>
    
    <?php endif; ?>
    <link rel="stylesheet" href="/<?=$realPath?>assets/css/style.css?v=<?=$RabiwebVersion?>">

    <?php if ($readSettings['analyticsStatus']==1): ?>

    <script async src="https://www.googletagmanager.com/gtag/js?id=<?=$readSettings['analyticsID']?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', '<?=$readSettings['analyticsID']?>');
    </script>

    <?php endif; ?>

    <style type="text/css">

        <?php
        
        $colorsDecode = json_decode(base64_decode($readTheme['colors']), true);

        $colors = $colorsDecode['color'];
        
        ?>

        :root {
            --body: <?=$colors[0]?>;
            --footer: <?=$colors[1]?>;
            --primary: <?=$colors[2]?>;
            --secondary: <?=$colors[3]?>;
            --tertiary: <?=$colors[4]?>;
            --white: <?=$colors[5]?>;
            --success: <?=$colors[6]?>;
            --blue: <?=$colors[7]?>;
            --slice-bg: url('<?=$find_read_page.$readTheme["sliceBg"]?>');
        }

        <?php if ($readTheme['headerBgStatus']==1): ?>
            
            #header {background: url('<?=$find_read_page.$readTheme["headerBg"]?>');background-size: cover;background-repeat: no-repeat;}

        <?php endif; ?>

        <?=$readTheme['css']?>    
        
    </style>

</head>

<body>