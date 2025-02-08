<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="Rabiweb Yazılım Hizmetleri">
        <link rel="shortcut icon" type="image/x-icon" href="<?=$find_read_page.$readSettings['serverFavicon']?>">
        <meta name="description" content="<?=$readSettings['googleDescription']?>">
        <meta name="keywords" content="<?=$readSettings['googleTags']?>">
        <base href="<?=site_url()?>">
        <title><?=$siteTitle?></title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        
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

        .g-recaptcha div {width: 100% !important;}

        <?=$readTheme['css']?>

        .password-show {transition: all 0.3s ease;color: var(--white);}
        .password-show:hover {color: var(--primary);}

        <?php if ($readTheme['loginBgStatus']==1): ?>
            
        .sign-in-bg {

            background-image: url("<?=$find_read_page.$readTheme['loginBg']?>") !important;
            background-repeat: no-repeat !important;
            background-attachment: fixed !important;
            background-position: top !important;
        
        }

        <?php endif; ?>
        
        </style>

        <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="/<?=$realPath?>assets/css/style.css">
    </head>

    <body>

        <div class="sign-in-bg"></div>

        <div class="video-background">
            <div class="video-foreground">
                <?php if ($readTheme['loginBgStatus']==0): ?>
                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$readTheme['youtubeEmbed']?>?controls=0&showinfo=0&rel=0&autoplay=1&?version=3&loop=1&playlist=Z34SBGwdbq8&mute=1&enablejsapi=1&disablekb=1&iv_load_policy=3&modestbranding=1"></iframe>
                <?php endif; ?>
            </div>
        </div>

        <section id="sign-in">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mx-auto d-flex align-items-center vh-100 z-index-2">
                        <div class="card opacity-08 w-100 sidebar">
                            <form action="" method="post">
                                <div class="card-header text-center d-flex justify-content-between align-items-center">
                                    <div class="header-content">
                                        <i class="mdi mdi-login mr-2"></i>
                                        Giriş Yap
                                    </div>
                                    <a href="kayit-ol" class="btn btn-2 py-2">Kayıt Ol</a>
                                </div>
                                <div class="card-body">
                                    <?=(isset($response))?$response:""?>
                                    <div class="form-group">
                                        <label for="username">Kullanıcı Adı:</label>
                                        <input type="text" name="username" class="form-control" id="username">
                                    </div>
                                    <div class="form-group">

                                        <label for="password">Şifre:</label>

                                        <label class="float-right">

                                            <a href="sifremi-unuttum">
                                                Şifremi Unuttum
                                            </a>
                                            
                                        </label>

                                        <div class="password-input position-relative">

                                            <input type="password" class="form-control" id="password" name="password">

                                            <a class="password-show" style="padding: 6px 10px;position: absolute;right: 1px;top: 1px;" onclick="showPassword('password')">
                                                <i class="mdi mdi-eye"></i>
                                            </a>

                                        </div>

                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" name="rememberMe" value="1" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Beni Hatırla</label>
                                    </div>
                                    <?php

                                    if ($readSettings['recaptchaStatus']==1):
            
                                        $recaptchaData = json_decode(base64_decode($readSettings['recaptchaActive']), true);

                                        if ($recaptchaData['loginRecaptcha']=="on"):

                                    ?>
                                    <div class="form-group mb-0 text-center">
                                        <div class="g-recaptcha" data-sitekey="<?=$readSettings['recaptchaSiteKey']?>" data-theme="dark"></div>
                                    </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer">
                                    <a href="./" class="btn btn-2 py-2">Geri Dön</a>
                                    <button type="submit" class="btn btn-1 py-2 float-right">Giriş Yap</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
        
        <?php if (isset($externalJS)) : ?>
    
            <?php foreach ($externalJS as $externalURL) : ?>
        
                <script src="<?=$externalURL?>"></script>
        
            <?php endforeach; ?>
        
        <?php endif; ?>

        <script type="text/javascript">
            function showPassword(input){
            
                var passwordInput = document.getElementById(input);

                if (passwordInput.type === "password") {
                
                    passwordInput.type = "text";
              
                }else{
                
                    passwordInput.type = "password";
            
                }
            
            }
        </script>

    </body>
</html>