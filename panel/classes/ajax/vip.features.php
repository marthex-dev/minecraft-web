<?php

session_start();

require '../../../connect.php';
require '../../helper.php';

if (session('login')):

	$vipFeatures = $db->from('VipFeatures')->where('serverID', post('serverID'))->all();

	if ($vipFeatures):

		foreach ($vipFeatures as $key => $readFeatures):
	
?>
			<tr>
				<td class="text-right">
					<?=$readFeatures['heading']?> :
				</td>
				<td class="text-center w-100">
				    <input type="text" class="form-control" name="<?=$readFeatures['slug']?>" placeholder="Özellik değerini giriniz.">
				</td>
			</tr>
		<?php endforeach; ?>

	<?php else: ?>

		<tr>
			<td colspan="2" class="text-center">
				Öncelikle özellik ekleyiniz.
			</td>
		</tr>

	<?php endif; ?>

<?php endif; ?>