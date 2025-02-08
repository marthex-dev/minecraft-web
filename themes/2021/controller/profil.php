<?php

if (!$_SESSION['login']) header('Location:' . site_url() . '/giris-yap');

if (!isset($action[1]) && isset($readUser)):

	$totalTickets = $db->from('SupportTickets')->join('Users', 'Users.id = SupportTickets.accID')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->where('accID', $readUser['id'])->where('SupportTickets.status', '5', '!=')->select('count(*) as total')->total();

	if ($totalTickets > 0):

	$tickets = $db->from('SupportTickets')
		->where('SupportTickets.accID', $readUser['id'])
		->where('SupportTickets.status', '5', '!=')
		->join('Users', 'Users.id = SupportTickets.accID')
		->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
		->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status')
		->orderBy('SupportTickets.updateDate', 'Desc')
        ->limit(0, 5)
		->all();

	endif;

	$totalStoreHistory = $db->from('StoreHistory')->join('Users', 'Users.id = StoreHistory.accID')->join('Products', 'Products.id = StoreHistory.productID')->join('Servers', 'Servers.id = StoreHistory.serverID')->where('StoreHistory.accID', $readUser['id'])->select('count(*) as total')->total();

	if ($totalStoreHistory > 0):

	$storeHistory = $db->from('StoreHistory')
						->where('StoreHistory.accID', $readUser['id'])
                		->join('Users', 'Users.id = StoreHistory.accID')
                		->join('Products', 'Products.id = StoreHistory.productID')
                		->join('Servers', 'Servers.id = StoreHistory.serverID')
                		->select('Users.username, Servers.heading as serverName, Products.heading, StoreHistory.id, StoreHistory.price, StoreHistory.creationDate')
                		->orderby('StoreHistory.id', 'desc')
                		->limit(0, 5)
                		->all();

	endif;

	$totalCreditHistory = $db->from('CreditHistory')->where('accID', $readUser['id'])->where('CreditHistory.paymentStatus', '1')->select('count(*) as total')->total();

	if ($totalCreditHistory > 0):
    
    	$creditHistory = $db->from('CreditHistory')->where('CreditHistory.accID', $readUser['id'])->join('Users', 'Users.id = CreditHistory.accID')->select('Users.username, CreditHistory.price, CreditHistory.type, CreditHistory.creationDate')->where('CreditHistory.paymentStatus', '1')->orderby('CreditHistory.id', 'desc')->limit(0, 5)->all();

	endif;

elseif (isset($action[1]) && $action[1]=="duzenle"):

	if ($_POST):
        
        if (!empty(post('password'))):

            $password = post('password');

            if ($readSettings['encryptionMethod']==0):
    
                $realPassword = checkSHA256($password, $readUser['password']);
    
            elseif($readSettings['encryptionMethod']==1):
    
                $password = md5($password);
    
                if ($password == $readUser['password']):
    
                    $realPassword = true;
    
                else:
    
                    $realPassword = false;
    
                endif;
    
            endif;

            if ($realPassword == true):
            
                $data = array(
                    'id' => $readUser['id'],
                    'email' => post('email'),
                    'skype' => post('skype'),
                    'discord' => post('discord')
                );

                $updateUser = $db->update('Users')->where('id', $data['id'])->set($data);

                if ($updateUser):
                    
                    $response = alert('success', 'Profiliniz başarıyla güncellendi.');

                else:

                    $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                endif;

            else:

                $response = alert('danger', 'Girdiğiniz şifre hatalı!');

            endif;

        else:

            $response = alert('danger', 'Lütfen şifrenizi giriniz.');

        endif;

    endif;

elseif (isset($action[1]) && $action[1]=="sifre-degistir"):

	if ($_POST):
        
        if (!empty(post('newPassword')) && !empty(post('newPasswordRe')) && !empty(post('password'))):
            
            $password = post('password');

            if ($readSettings['encryptionMethod']==0):
    
                $realPassword = checkSHA256($password, $readUser['password']);
    
            elseif($readSettings['encryptionMethod']==1):
    
                $password = md5($password);
    
                if ($password == $readUser['password']):
    
                    $realPassword = true;
    
                else:
    
                    $realPassword = false;
    
                endif;
    
            endif;

            if ($realPassword == true):

                if (post('newPassword') == post('newPasswordRe')):

                    if ($readSettings['encryptionMethod']==0):

                        $data['password'] = createSHA256(post('newPassword'));

                    elseif($readSettings['encryptionMethod']==1):

                        $data['password'] = md5(post('newPassword'));

                    endif;

                    $updateUser = $db->update('Users')->where('id', $readUser['id'])->set($data);

                    if ($updateUser):
                        
                        $response = alert('success', 'Şifreniz başarıyla güncellendi.');

                    else:

                        $response = alert('danger', 'Hata! Yetkiliyle iletişime geçiniz.');

                    endif;

                else:

                    $response = alert('danger', 'Girilen şifreler eşleşmiyor.');

                endif;

            else:

                $response = alert('danger', 'Girdiğiniz şifre hatalı!');

            endif;

        else:

            $response = alert('danger', 'Lütfen boş alan bırakmayınız.');

        endif;

    endif;

endif;

require $realPath . '/view/profile.php';