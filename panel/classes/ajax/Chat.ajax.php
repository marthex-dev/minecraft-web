<?php

session_start();

if ($_SESSION['login']):

require '../../../connect.php';
require '../../helper.php';

if (get('type') == "get"):

	$totalAdminChat = $db->from('AdminChat')->select('count(*) as total')->total();
	
	if ($totalAdminChat > 0):
		
		$adminChat = $db->from('AdminChat')
						->join('Users', 'Users.id = AdminChat.accID')
						->select('AdminChat.*, Users.username')
						->orderby('AdminChat.id', 'ASC')
						->limit(0, 20)
						->all();
	
	endif;

?>

	<?php if ($totalAdminChat > 0): ?>

		<?php foreach ($adminChat as $key => $readChat): ?>

		    <?php if ($key == 0): ?>

		    <div class="media">
		        <img class="mr-3 rounded-circle" src="https://minotar.net/avatar/<?=$readChat['username']?>/24" alt="Oyuncu - <?=$readChat['username']?>">
		        <div class="media-body">
		            <a href="hesap/goruntule/<?=$readChat['accID']?>">
		                <strong class="mt-0"><?=$readChat['username']?></strong>
		            </a>
		            <div class="float-right">
		                <?=convertTime($readChat['creationDate'], 2, true)?>
		            </div>
		            <div class="media-content">
		                <?=$readChat['message']?>
		            </div>
		        </div>
		    </div>

		    <?php else: ?>

		    <hr>

		    <div class="media">
		        <img class="mr-3 rounded-circle" src="https://minotar.net/avatar/<?=$readChat['username']?>/24" alt="Oyuncu - <?=$readChat['username']?>">
		        <div class="media-body">
		            <a href="hesap/goruntule/<?=$readChat['accID']?>">
		                <strong class="mt-0"><?=$readChat['username']?></strong>
		            </a>
		            <div class="float-right">
		                <?=convertTime($readChat['creationDate'], 2, true)?>
		            </div>
		            <div class="media-content">
		                <?=$readChat['message']?>
		            </div>
		        </div>
		    </div>

		    <?php endif; ?>

		<?php endforeach; ?>

	<?php endif; ?>

<?php 

	elseif (get('type') == "submit"):

		$readUser = $db->from('Users')->where('username', $_SESSION['username'])->select('count(*) as total, Users.*')->first();

		if (!empty(post('message')) && $readUser['total'] > 0):
			
			$data = array(
				'accID' => $readUser['id'],
				'message' => post('message'),
				'creationDate' => date('Y-m-d H:i:s')
			);

			$insertMessage = $db->insert('AdminChat')->set($data);

		endif;

	endif; 

endif;

?>