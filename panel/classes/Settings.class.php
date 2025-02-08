<?php


class settings
{

    public static function settingsUpdate($data)
    {

        global $db;

        $query = $db->update('Settings')
            ->where('id', "1")
            ->set($data);

        if ($query):
            return true;
        endif;

    }

    public static function getSettingsInfo()
    {

        global $db;

        $query = $db->from('Settings')->where('id', '1')->first();

        if ($query)
            return $query;
        return false;

    }
}