<?php

if (isset($_SESSION['login']) && $_SESSION['login']) header('Location:' . site_url());

if ($readSettings['recaptchaStatus']=="1"):

    $recaptchaData = json_decode(base64_decode($readSettings['recaptchaActive']), true);

    if ($recaptchaData['registerRecaptcha']=="on"):

        $externalJS = array('https://www.google.com/recaptcha/api.js');

    endif;

endif;

if ($_POST):

    $data = array(
        'email' => post('email'),
        'username' => post('username'),
        'realname' => post('username'),
        'password' => post('password')
    );

    if (!empty($data['email']) && !empty($data['username']) && !empty($data['password']) && !empty(post('passwordRe')) && !empty(post('rules'))):

        if ($readSettings['recaptchaStatus']=="1"):

            if ($recaptchaData['registerRecaptcha']=="on"):
                
                $secretKey = $readSettings['recaptchaSecretKey'];
                $responseKey = post('g-recaptcha-response');
                $reCaptchaUrl = "https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$responseKey;
                $reCaptchaResponse = file_get_contents($reCaptchaUrl);
                $reCaptchaResponse = json_decode($reCaptchaResponse);
                if ($reCaptchaResponse->success):

                    $reCaptcha = true;

                else:

                    $reCaptcha = false;

                endif;

            else:

                $reCaptcha = true;

            endif;

        else:

            $reCaptcha = true;

        endif;

        if ($reCaptcha == true):

            if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)):

                if ($data['password'] == post('passwordRe')):
                    
                    if (checkBadPassword($data['password'])==false):
                        
                        $username = $db->from('Users')->where('username', $data['username'])->or_where('email', $data['email'])->select('count(*) as total, Users.*')->first();

                        if ($username['total'] < 1):

                            $regTotal = $db->from('Users')->where('regip', getIP())->select('count(*) as total')->total();

                            if($regTotal <= $readSettings['registerLimit']):

                                if ($readSettings['encryptionMethod']==0):

                                    $data['password'] = createSHA256($data['password']);

                                elseif($readSettings['encryptionMethod']==1):

                                    $data['password'] = md5($data['password']);

                                endif;

                                $data['regdate'] = strtotime(date("Y-m-d H:i:s"))*1000;
                                $data['lastlogin'] = strtotime(date("Y-m-d H:i:s"))*1000;
                                $data['ip'] = getIP();
                                $data['regip'] = getIP();

                                $insertAccount = $db->insert('Users')->set($data);

                                if ($insertAccount):

                                    $loginToken = md5(uniqid(mt_rand(), true));

                                    $sessionData = array(
                                        'accID' => $db->lastInsertId(),
                                        'loginToken' => $loginToken,
                                        'creationIP' => getIP(),
                                        'expiryDate' => createDuration(0.01666666666),
                                        'creationDate' => date("Y-m-d H:i:s")
                                    );

                                    $insertSession = $db->insert('Sessions')->set($sessionData);

                                    $_SESSION['token'] = $loginToken;
                                    $_SESSION['login'] = true;
                                    $_SESSION['username'] = $data['username'];

                                    header('Location:' . site_url() . '/profil');
                                    
                                else:

                                    alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                                endif;

                            else:

                                $response = alert('danger', 'Daha fazla kayıt olamazsınız.');

                            endif;

                        else:

                            $response = alert('danger', 'Kullanıcı adı veya mail adresiniz kullanımda.');

                        endif;

                    else:

                        $response = alert('danger', 'Şifreniz çok basit.');

                    endif;

                else:

                    $response = alert('danger', 'Girdiğiniz Şifreler Uyuşmuyor.');

                endif;

            else:

                $response = alert('danger', 'Lütfen geçerli bir e-Posta adresi girin.');

            endif;

        else:

            $response = alert('danger', 'reCaptcha onaylamanız gerekmekte.');

        endif;

    else:

        $response = alert('danger', 'Lütfen boş alan bırakmayınız.');

    endif;

endif;

require $realPath . '/view/sign-up.php';