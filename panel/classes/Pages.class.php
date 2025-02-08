<?php


class pages
{

    public static function addPages($data)
    {

        global $db;

        $query = $db->insert('Pages')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function editPages($data)
    {

        global $db;

        $query = $db->update('Pages')
            ->where('id', $data['id'])
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function deletePages($data)
    {

        global $db;

        $query = $db->delete('Pages')
            ->where('id', $data)
            ->done();

        if ($query)
            return true;
        return false;

    }

}