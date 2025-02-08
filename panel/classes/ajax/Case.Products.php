<?php

session_start();

require '../../../connect.php';
require '../../helper.php';

if ($_SESSION['login']):

	if ($_POST):

		$totalCategories = $db->from('ProductsCategories')->where('serverID', post('id'))->select('count(*) as total')->total();

		if ($totalCategories > 0):
			
			$totalProducts = $db->from('Products')->where('serverID', post('id'))->select('count(*) as total')->total();

			if ($totalProducts > 0):
				
				$categories = $db->from('ProductsCategories')->where('serverID', post('id'))->all();

				foreach ($categories as $readCategories):
					
					echo "<optgroup label=" . $readCategories['heading'] . "></optgroup>";

					$products = $db->from('Products')->where('serverID', post('id'))->where('categoryID', $readCategories['id'])->all();

					foreach ($products as $readProducts):
						
						echo '<option value="' . $readProducts["id"] . '">'. $readProducts["heading"] . '</option>';

					endforeach;

				endforeach;

			else:

				echo "<option> Henüz Ürün Eklenmemiş </option>";

			endif;

		else:

			echo "<option> Henüz Kategori Eklenmemiş </option>";

		endif;

	endif;

endif;

?>