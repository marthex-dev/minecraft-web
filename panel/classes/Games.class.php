<?php


class games
{

    public static function addGames($data)
    {

        global $db;

        $query = $db->insert('Games')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function editGames($data, $image = false)
    {

        global $db;

        if($image == "0"):

            $games = $db->from('Games')->where('id', $data['id'])->first();

            $data['image'] = $games['image'];

        endif;

        $data['updateDate'] = date('Y-m-d H:i:s');

        $query = $db->update('Games')
            ->where('id', $data['id'])
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function deleteGame($data)
    {

        global $db;

        $query = $db->delete('Games')
            ->where('id', $data)
            ->done();

        if ($query)
            return true;
        return false;

    }

}