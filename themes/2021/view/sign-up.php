<?php include('static/header.php');?>
<section id="sign-in">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 mx-auto vh-100 d-flex align-items-center z-index-2">
                        <div class="card opacity-08 w-100 sidebar">
                            <form action="" method="post">
                                <div class="card-header text-center d-flex justify-content-between align-items-center">
                                    <div class="header-content">
                                        <i class="mdi mdi-account-plus mr-2"></i>
                                        Kayıt Ol
                                    </div>
                                    <a href="giris-yap" class="btn btn-2 py-2">Giris Yap</a>
                                </div>
                                <div class="card-body">
                                    <?=(isset($response))?$response:""?>
                                    <div class="form-group">
                                        <label for="username">Kullanıcı Adı:</label>
                                        <input type="text" name="username" class="form-control" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">E-Posta Adresi:</label>
                                        <input type="text" name="email" class="form-control" id="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Şifre:</label>

                                        <div class="password-input position-relative">

                                            <input type="password" class="form-control" id="password" name="password">

                                            <a class="password-show" style="padding: 6px 10px;position: absolute;right: 1px;top: 1px;" onclick="showPassword('password')">
                                                <i class="mdi mdi-eye"></i>
                                            </a>

                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="passwordRe">Şifre (Tekrar):</label>

                                        <div class="password-input position-relative">

                                            <input type="password" class="form-control" id="passwordRe" name="passwordRe">

                                            <a class="password-show" style="padding: 6px 10px;position: absolute;right: 1px;top: 1px;" onclick="showPassword('passwordRe')">
                                                <i class="mdi mdi-eye"></i>
                                            </a>

                                        </div>
                                        
                                    </div>
                                    <div class="form-group form-check">
                                        <input type="checkbox" name="rules" value="1" class="form-check-input" id="rules">
                                        <label class="form-check-label" for="rules"><a type="button" data-toggle="modal" data-target="#exampleModalCenter" href="#">Kuralları</a> okudum ve kabul ediyorum</label>
                                    </div>
                                    <?php

                                    if ($readSettings['recaptchaStatus']==1):
            
                                        $recaptchaData = json_decode(base64_decode($readSettings['recaptchaActive']), true);

                                        if ($recaptchaData['registerRecaptcha']=="on"):

                                    ?>
                                    <div class="form-group mb-0 text-center">
                                        <div class="g-recaptcha" data-sitekey="<?=$readSettings['recaptchaSiteKey']?>" data-theme="dark"></div>
                                    </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-1 py-2">Kayıt Ol</button>
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
<?php include('static/footer.php');?>