<!DOCTYPE html>
<html lang="tr">

<head>
	<meta charset="UTF-8" />

	<title><?=$siteTitle?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=$find_read_page.$readSettings['serverFavicon']?>">
    <meta name="description" content="<?=$readSettings['googleDescription']?>">
    <meta name="keywords" content="<?=$readSettings['googleTags']?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<base href="<?=site_url()?>">
	<link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
	<link rel="stylesheet" type="text/css" media="all" href="/<?=$realPath?>css/style.css" />

	<script>
		(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);
	</script>

	<style type="text/css">
		#iframe_bg-video {transform: scale(1.2);}
		:root {
			--primary: #F3755D;
		};
	</style>

</head>

<body>
	<div class="wrap">
		<main id="main" class="site-main">

			<div id="front" class="site-front">
				<div class="inner">

					<header class="site-header">
						<p class="site-logo fade-in"><img src="<?=$find_read_page.$readTheme['headerLogo']?>" width="300" alt="<?=$readSettings['serverName']?> Logo" /></p>
						<h1 class="site-title screen-reader-text"><?=$readSettings['serverName']?></h1>
					</header>

					<section class="content">
						<h2 class="section-title"><?=$maintenanceData['maintenanceHeading']?></h2>

						<div class="countdown-timer">
							<p class="subtitle"><?=$maintenanceData['maintenanceContent']?></p>
							
							<?php if ($maintenanceData['maintenanceDuration'] == 1): ?>
							
							<div id="timer"></div>

							<?php endif; ?>

						</div>

						<div class="social-links">
							<?php if (!empty($readSettings['facebookURL'])): ?>
							<a href="<?=$readSettings['facebookURL']?>" target="_blank">
								<i class="mdi mdi-facebook" aria-hidden="true"></i>
								<span class="screen-reader-text">Facebook</span>
							</a>
							<?php endif; ?>

							<?php if (!empty($readSettings['twitterURL'])): ?>
							<a href="<?=$readSettings['twitterURL']?>" target="_blank">
								<i class="mdi mdi-twitter" aria-hidden="true"></i>
								<span class="screen-reader-text">Twitter</span>
							</a>
							<?php endif; ?>

							<?php if (!empty($readSettings['instagramURL'])): ?>
							<a href="<?=$readSettings['instagramURL']?>" target="_blank">
								<i class="mdi mdi-instagram" aria-hidden="true"></i>
								<span class="screen-reader-text">Instagram</span>
							</a>
							<?php endif; ?>

							<?php if (!empty($readSettings['youtubeURL'])): ?>
							<a href="<?=$readSettings['youtubeURL']?>" target="_blank">
								<i class="mdi mdi-youtube" aria-hidden="true"></i>
								<span class="screen-reader-text">Youtube</span>
							</a>
							<?php endif; ?>

							<?php if (!empty($readSettings['discordURL'])): ?>
							<a href="<?=$readSettings['discordURL']?>" target="_blank">
								<i class="mdi mdi-discord" aria-hidden="true"></i>
								<span class="screen-reader-text">Discord</span>
							</a>
							<?php endif; ?>

						</div>

					</section>

				</div>
			</div>

		</main>
	</div>

	<div class="overlay"></div>

	<div id="bg-video" data-property="{videoURL:'http://youtu.be/<?=$readTheme['youtubeEmbed']?>', containment:'body', autoPlay:true, mute:true, startAt:0, showControls:true, mobileFallbackImage:'images/poster.jpg'}"></div>
	<div id="bg-video-controls">
		<button id="bg-video-volume"><i class="fa-volume-off-custom" aria-hidden="true"></i> <span class="screen-reader-text">Unmute</span></button><button id="bg-video-play" style="border-right: 1px dotted #dadada;border-color: rgba(218,218,218,0.8);"><i class="fa-pause-custom" aria-hidden="true"></i> <span class="screen-reader-text">Pause</span></button><?php if (!isset($_SESSION['login'])): ?><a href="giris-yap" style="border-right: 1px dotted #dadada;border-color: rgba(218,218,218,0.8);">
			<i class="mdi mdi-account" aria-hidden="true"></i>
			<span class="screen-reader-text">Giriş Yap</span>
		</a><a href="kayit-ol">
			<i class="mdi mdi-account-plus" aria-hidden="true"></i>
			<span class="screen-reader-text">Kayıt Ol</span>
		</a>
		<?php elseif ($_SESSION['login'] && $readUser['permission'] != 0 && $readUser['permission'] != 1): ?>
		<a href="panel/" target="_blank" style="border-right: 1px dotted #dadada;border-color: rgba(218,218,218,0.8);">
			<i class="mdi mdi-view-dashboard-outline" aria-hidden="true"></i>
			<span class="screen-reader-text">Yönetim Paneli</span>
		</a>
		<a href="cikis-yap" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?')">
			<i class="mdi mdi-logout" aria-hidden="true"></i>
			<span class="screen-reader-text">Çıkış Yap</span>
		</a>
		<?php else: ?>
		<a href="cikis-yap" target="_blank" onclick="return confirm('Çıkış yapmak istediğinize emin misiniz?')">
			<i class="mdi mdi-logout" aria-hidden="true"></i>
			<span class="screen-reader-text">Çıkış Yap</span>
		</a>
		<?php endif; ?>
	</div>

	<div id="preload">
		<div id="preload-content">
			<div class="preload-spinner">
				<span class="bounce1"></span>
				<span class="bounce2"></span>
				<span class="bounce3"></span>
			</div>
			<div class="preload-text">Yükleniyor...</div>
		</div>
	</div>

	<script type="text/javascript" src="/<?=$realPath?>js/scripts.js"></script>
 
	<?php if ($maintenanceData['maintenanceDuration'] == 1): ?>

	<?php

	$jsDate = explode("-", $maintenanceData['maintenanceExpiry']);
	$jsTime = explode(":", $maintenanceData['maintenanceExpiryTime']);

	?>

	<script type="text/javascript">
		$(document).ready(function() {

        	var launchDay = new Date(<?=$jsDate[0]?>, <?=$jsDate[1]?> - 1, <?=$jsDate[2]?>, <?=$jsTime[0]?>, <?=$jsTime[1]?>);
        	$('#timer').countdown({
        	    until: launchDay,
        	    format: 'dHMS'
        	});

    	});
	</script>

	<?php endif; ?>

</body>
</html>