<?php

session_start();

require '../../../connect.php';
require '../../helper.php';

if ($_POST):

	if ($_SESSION['login']):

		if (get('type')=="add"):
			
			if (!empty(post('heading')) && !empty(post('link'))):

				if (post('id') != ''):
					
					$data = array(
						'id' => post('id'),
						'heading' => post('heading'),
						'icon' => post('icon'),
						'link' => post('link'),
						'tab' => post('tab')
					);

					$updateMenu = $db->update('Menu')->where('id', post('id'))->set($data);

					if ($updateMenu):
						
						$data['rType'] = "update";

					else:

						echo 3;

					endif;
				
				else:

					$readMenu = $db->from('Menu')->where('parent', '0')->select('count(*) as total, Menu.*')->orderby('sort', 'desc')->first();

					if ($readMenu['total'] > 0):
						
						$sort = $readMenu['sort']+1;

					else:

						$sort = 0;

					endif;

					$data = array(
						'heading' => post('heading'),
						'icon' => post('icon'),
						'link' => post('link'),
						'tab' => post('tab'),
						'parent' => '0',
						'sort' => $sort
					);

					$insertMenu = $db->insert('Menu')->set($data);

					if ($insertMenu):
						
						$data['id'] = $db->lastInsertID();
						$data['rType'] = "add";

					else:

						echo 3;

					endif;

				endif;

				echo json_encode($data);

			else:

				echo 2;

			endif;

		elseif (get('type')=="update"):

			$data = json_decode($_POST['data']);

			function parseJsonArray($jsonArray, $parentID = 0) {

				$return = array();

				foreach ($jsonArray as $subArray):
				
					$returnSubSubArray = array();
				
					if (isset($subArray->children)):

						$returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
					
					endif;

					$return[] = array('id' => $subArray->id, 'parentID' => $parentID);
					$return = array_merge($return, $returnSubSubArray);
				
				endforeach;

				return $return;

			}

			$readableArray = parseJsonArray($data);

			$i=0;

			foreach($readableArray as $row):

				$i++;

				$updateMenu = $db->update('Menu')->where('id', $row['id'])->set(array('parent' => $row['parentID'], 'sort'=> $i));

			endforeach;

		elseif (get('type')=="read"):

			$readMenu = $db->from('Menu')->where('id', post('id'))->first();

			echo json_encode($readMenu);

		elseif (get('type')=="delete"):

			$deleteMenu = $db->delete('Menu')->where('id', post('id'))->done();

		endif;

	else:
		
		echo 1;

	endif;

endif;