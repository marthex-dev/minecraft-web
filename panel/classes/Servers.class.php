<?php


class server
{

    public static function getServer($data = false, $type = 0)
    {

        global $db;

        if ($data != false && $type == 0):
            
            $total = $db->from('Servers')->where('id', $data)->select('count(*) as total')->total();

        elseif ($data != false && $type == 1):

            $total = $db->from('Servers')->like('heading', $data)->select('count(*) as total')->total();

        else:

            $total = $db->from('Servers')->select('count(*) as total')->total();

        endif;

        if ($total > 0):
            
            if ($data != false && $type == 0):
                
                $query = $db->from('Servers')->where('id', $data)->first();

            elseif ($data != false && $type == 1):

                $query = $db->from('Servers')->like('heading', $data)->all();

            else:

                $query = $db->from('Servers')->all();

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

    public static function addServer($data)
    {

        global $db;

        $query = $db->insert('Servers')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function updateServer($data)
    {
        global $db;

        $query = $db->update('Servers')
            ->where('id', $data['id'])
            ->set($data);

        if ($query)
            return true;
        return false;
    }

    public static function deleteServer($data)
    {

        global $db;

        $query = $db->delete('Servers')
            ->where('id', $data)
            ->done();

        if ($query):
            return true;
        endif;

    }

}