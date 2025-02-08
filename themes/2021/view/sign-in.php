<?php include('static/header.php')?>
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
                                    <button type="submit" class="btn btn-1 py-2 justify-content-center align-items-center">Giriş Yap</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
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
<?php include('static/footer.php')?>
