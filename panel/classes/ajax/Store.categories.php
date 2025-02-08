<?php

require '../../../connect.php';
require '../../helper.php';

if (isset($_POST['categoryID'])): 
	
	$total = $db->from('ProductsCategories')->where('serverID', post('id'))->where('id', post('categoryID'), '!=')->where('parent', post('categoryID'), '!=')->select('count(*) as total')->total();

else:

	$total = $db->from('ProductsCategories')->where('serverID', post('id'))->select('count(*) as total')->total();

endif;

if ($total > 0):

	if (isset($_POST['categoryID'])): 

    	$subCategory=array();

		$subCategory[] = post('categoryID');

		$notInCategories = $db->from('ProductsCategories')->where('id', post('categoryID'))->all();

		foreach ($notInCategories as $value):
		    subCategory($value['id']);
		endforeach;

		$notInCategory = implode(',', $subCategory);

		$categories = $db->from('ProductsCategories')
        ->notIn('id', [$notInCategory])
        ->where('serverID', post('id'))
        ->all();

    else:

    	$categories = $db->from('ProductsCategories')->where('serverID', post('id'))->all();

    endif;

	if($categories): ?>

		<?php if(post('type')==1): ?>
			
			<option>Kategori Seçiniz</option>

		<?php else: ?>

			<option value="0">Kategorisiz</option>

		<?php endif; ?>

	    <?php foreach ($categories as $readCategory): ?>
	
	        <option value="<?=$readCategory['id']?>"><?=$readCategory['heading']?></option>
	
	    <?php endforeach; ?>
	
	<?php endif; ?>

<?php else: ?>

	<?php if(post('type')==1): ?>

		<option>Kategori Ekleyiniz</option>

	<?php else: ?>

		<option value="0">Kategorisiz</option>

	<?php endif; ?>	

<?php endif; ?>