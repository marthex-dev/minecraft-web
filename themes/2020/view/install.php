<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="RabiWeb Yazılım Hizmetleri">
        <base href="<?="http://" . $_SERVER['HTTP_HOST'] . "/"?>">
        <title>Kurulum | RabiWeb Yazılım Hizmetleri</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
        
        <style type="text/css">

            :root {
                --body: #1C1C1C;
                --footer: #272727;
                --primary: #F3755D;
                --secondary: #FBD7D7;
                --tertiary: #2A2A2A;
                --white: #FFFFFF;
                --success: #61DF69;
                --blue: #7F9DFF;
            }

            .sign-in-bg {background: rgba(0,0,0, 0.3);position: absolute;left: 0;top: 0;z-index: 1;width: 100%;height: 100%;}
            .video-background {position: absolute;left: 0;top: 0;width: 100%;height: 100%;overflow: hidden;}
            .video-foreground {height: 100%;transform: scale(1.3);}
        
        </style>

        <link rel="stylesheet" href="//cdn.materialdesignicons.com/5.4.55/css/materialdesignicons.min.css">
    </head>

    <body>

        <div class="sign-in-bg"></div>

        <div class="video-background">
            <div class="video-foreground">
                <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?=$readTheme['youtubeEmbed']?>?controls=0&showinfo=0&rel=0&autoplay=1&?version=3&loop=1&playlist=Z34SBGwdbq8&mute=1&enablejsapi=1&disablekb=1&iv_load_policy=3&modestbranding=1"></iframe>
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
                                        Kurulum
                                    </div>
                                </div>
                                <div class="card-body">
                                    
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
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" class="form-check-input" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">Beni Hatırla</label>
                                    </div>

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

    </body>
</html>