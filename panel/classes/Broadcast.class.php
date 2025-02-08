<?php


class broadcast
{

    public static function addBroadcast($data)
    {

        global $db;

        $query = $db->insert('Broadcast')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function updateBroadcast($data)
    {
        global $db;

        $query = $db->update('Broadcast')
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