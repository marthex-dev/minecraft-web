<?php


class theme
{

    public static function themeUpdate($data)
    {

        global $db;

        $query = $db->update('Theme')
            ->where('id', "1")
            ->set($data);

        if ($query):
            return true;
        endif;

    }

    public static function getThemeInfo()
    {

        global $db;

        $query = $db->from('Theme')->where('id', '1')->first();

        if ($query)
            return $query;
        return false;

    }
}