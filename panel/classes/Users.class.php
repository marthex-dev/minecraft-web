<?php


class users
{

	public static function getUsers($data = false, $type = 0)
	{

		global $db;

        if ($data == "yetkili"):
            
            $total = $db->from('Users')->where('permission', '0', '!=')->select('count(*) as total')->total();

		elseif ($data != false && $type == 0):
			
			$total = $db->from('Users')->where('id', $data)->select('count(*) as total')->total();

        elseif ($data != false && $type == 1):

            $total = $db->from('Users')->where('username', $data, 'LIKE')->or_where('email', $data, 'LIKE')->or_where('id', $data, 'LIKE')->select('count(*) as total')->total();

		else:

			$total = $db->from('Users')->select('count(*) as total')->total();

		endif;

		if ($total > 0):

            if ($data == "yetkili"):

                $query = $db->from('Users')
                    ->where('permission', '0', '!=')
                    ->all();

			elseif ($data != false && $type == 0):

				$query = $db->from('Users')
					->where('id', $data)
					->first();

            elseif ($data != false && $type == 1):

                $query = $db->from('Users')->where('username', $data, 'LIKE')->or_where('email', $data, 'LIKE')->or_where('id', $data, 'LIKE')->all();

			else:

				$query = $db->from('Users')
				->all();

			endif;

			if ($query):

				return $query;

			else:

				return false;

			endif;

		else:

			return false;

		endif;

	}

    public static function addUsers($data)
    {

        global $db;

        $query = $db->insert('Users')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function updateUsers($data)
    {
        global $db;

        $query = $db->update('Users')
            ->where('id', $data['id'])
            ->set($data);

        if ($query)
            return true;
        return false;
    }

    public static function deleteBroadcast($data)
    {

        global $db;

        $query = $db->delete('Broadcast')
            ->where('id', $data)
            ->done();

        if ($query):
            return true;
        endif;

    }

}