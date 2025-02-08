<?php

if (isset($_SESSION['login'])) header('Location:' . site_url());

if ($readSettings['recaptchaStatus']=="1"):

    $recaptchaData = json_decode(base64_decode($readSettings['recaptchaActive']), true);

    if ($recaptchaData['loginRecaptcha']=="on"):

        $externalJS = array('https://www.google.com/recaptcha/api.js');

    endif;

endif;

if ($_POST):

    $username = post('username');
    $password = post('password');

    if (!empty($username) && !empty($password)):

        if ($readSettings['recaptchaStatus']=="1"):

            if ($recaptchaData['loginRecaptcha']=="on"):
                
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

            $info = $db->from('Users')->where('username', $username)->select('count(*) as total, Users.*')->first();

            if ($info['total'] > 0):

                if ($readSettings['encryptionMethod']==0):

                    $realPassword = checkSHA256($password, $info['password']);

                elseif($readSettings['encryptionMethod']==1):

                    $password = md5($password);

                    if ($password == $info['password']):

                        $realPassword = true;

                    else:

                        $realPassword = false;

                    endif;

                endif;

                $banned = $db->from('BannedUsers')->where('accID', $info['id'])->where('categoryID', '1')->where('expiryDate', date('Y-m-d'), '>')->select('count(*) as total, BannedUsers.*')->first();

                if ($banned['total'] > 0):

                    if ($banned['expiryDate']=="2099-12-29"):
            
                        $remainingTime = "Sınırsız";

                    else:

                        $remainingTime = $banned['expiryDate'];

                    endif;

                    if ($banned['reason']==1):
                        
                        $reason = "Spam";

                    elseif ($banned['reason']==2):

                        $reason = "Küfür / Hakaret";

                    elseif ($banned['reason']==3):

                        $reason = "Hile";

                    elseif ($banned['reason']==4):

                        $reason = "Reklam";

                    elseif ($banned['reason']==5):

                        $reason = "Oyuncuları Dolandırmak";

                    else: 

                        $reason = "Diğer";

                    endif;

                    $response = alert('danger','
                        Yasaklandığınız için giriş yapamadınız. 
                        <br>Yasaklanma Nedeni : <b>'.$reason.'</b> 
                        <br>Bitiş Tarihi : <b>'.$remainingTime.'</b>'
                    );

                else:

                    if ($realPassword == true):
                            
                        $loginToken = md5(uniqid(mt_rand(), true));

                        $sessionIP = getIP();

                        $sessionData = array(
                                'accID' => $info['id'],
                                'loginToken' => $loginToken,
                                'creationIP' => $sessionIP,
                                'expiryDate' => createDuration(((isset($_POST["rememberMe"])) ? 365 : 0.01666666666)),
                                'creationDate' => date("Y-m-d H:i:s")
                            );

                        if(isset($_POST['rememberMe']) && $_POST['rememberMe'] == "1"):

                            setcookie("rememberMe", $loginToken, time()+86400*365, "/");

                        endif;

                        $insertSession = $db->insert('Sessions')->set($sessionData);

                        $_SESSION['token'] = $loginToken;
                        $_SESSION['login'] = true;
                        $_SESSION['username'] = $info['username'];

                        $updateDate = $db->update('Users')->where('id', $info['id'])->set(['ip' => getIP(), 'lastlogin' => strtotime(date("Y-m-d H:i:s"))*1000]);

                        header('Location:' . site_url() . '/profil');

                    else:

                        $response = alert('danger', 'Giriş bilgilerinizi kontrol ediniz.');

                    endif;

                endif;

            else:

                $response = alert('danger', 'Kayıtlı kullanıcı bulunamadı.');

            endif;

        else:
        
            $response = alert('danger', 'reCaptcha onaylamanız gerekmekte.');

        endif;

    else:

        $response = alert('danger', 'Lütfen boş alan bırakmayınız!');

    endif;

endif;

require $realPath . '/view/sign-in.php';