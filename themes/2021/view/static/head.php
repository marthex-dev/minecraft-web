<?php

if (isset($readUser['username']) && !isset($_SESSION['username'])):
    
    $_SESSION["username"] = $readUser["username"];
    
endif;

?>

<?php 



?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Kutay Keskin">
    <link rel="shortcut icon" type="image/x-icon" href="<?=$find_read_page.$readSettings['serverFavicon']?>">
    <meta name="description" content="<?=$readSettings['googleDescription']?>">
    <?php if ($readSettings['commentsStatus'] > 1): ?>
    <meta name="keywords" content="<?=$readSettings['commetsStatus']?>">
    <?php else: ?>
    <meta name="keywords" content="<?=$readSettings['googleTags']?>">
    <?php endif; ?>
    <meta name="robots" content="all"/>
    <meta name="revisit-after" content="1 Days"/>
    <title><?=$siteTitle?></title>
    
    <meta property="og:locale" content="tr-TR"/>
    <meta property="og:site_name" content="<?=$siteTitle?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?=$siteTitle?>"/>
    <meta property="og:description" content="<?=$readSettings['googleDescription']?>"/>
    <meta property="og:image" content="https://rabi.web.tr/<?=$find_read_page.$readSettings['serverFavicon']?>"/>
    
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="<?=$siteTitle?>"/>
    <meta name="twitter:title" content="<?=$siteTitle?>"/>
    <meta name="twitter:description" content="<?=$readSettings['googleDescription']?>"/>
    <meta name="twitter:image" content="https://rabi.web.tr/<?=$find_read_page.$readSettings['serverFavicon']?>"/>
    
    <?php if ($readSettings['commentsStatus'] > 1): ?>
    <meta property="article:tag" content="<?=$readSettings['commetsStatus']?>"/>
    <?php endif; ?>
    
    
    
    
    <link rel="stylesheet" href="/<?=$realPath?>assets/css/bootstrap.css?v=<?=$RabiwebVersion?>">

    <link rel="stylesheet" href="/<?=$realPath?>assets/css/mdi.css?v=<?=$RabiwebVersion?>">
    <link rel="stylesheet" href="/<?=$realPath?>assets/css/swiper.css?v=<?=$RabiwebVersion?>" />
    <link rel="stylesheet" href="/<?=$realPath?>assets/css/pages/ranks.css?v=<?=$RabiwebVersion?>" />
    <script>var realPath = <?=$realPath?></script>
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
            .preload-logo{
                max-height: 128px;
                justify-content: center;
                text-align: center;
            }
            .servername{
                justify-content: center;
                padding-bottom: 20px;
            } 
            .servername-text{
                font-size: 25px;
                font-weight: bold;
                text-align: center;
                justify-content: center;
                color: <?=$colors[1]?>;
            }
            #preload {background: #111;bottom: 0;left: 0;position: fixed;right: 0;top: 0;z-index: 9998;display: flex;align-items: center;justify-content: center;}
            .preload-text {color: var(--white);font-family: 'Quicksand', sans-serif;font-size: 20px;text-align: center;}
            .preload-spinner {margin: 0 auto 20px;text-align: center;}
            .bounce1, .bounce2, .bounce3 {-webkit-animation: bounce 1.4s ease-in-out infinite both;animation: bounce 1.4s ease-in-out infinite both;background-color: var(--white);display: inline-block;height: 14px;margin: 0 3px;opacity: 1;width: 14px;}
            .bounce1 {-webkit-animation-delay: -0.32s;animation-delay: -0.32s;}
            .bounce2 {-webkit-animation-delay: -0.16s;animation-delay: -0.16s;}
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

            
            #header {
                background: var(--slice-bg);
                background-size: cover;
                background-repeat: no-repeat;
            }


        

        <?=$readTheme['css']?>    

    </style>

</head>

<body>