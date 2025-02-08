<?php


class download
{

    public static function addFiles($data)
    {

        global $db;

        $query = $db->insert('Downloads')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function editFiles($data)
    {

        global $db;

        $query = $db->update('Downloads')
            ->where('id', $data['id'])
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function deleteFiles($data)
    {

        global $db;

        $query = $db->delete('Downloads')
            ->where('id', $data)
            ->done();

        if ($query)
            return true;
        return false;

    }

}