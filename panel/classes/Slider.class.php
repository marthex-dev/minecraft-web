<?php


class slider
{

    public static function addSlider($data)
    {

        global $db;

        $query = $db->insert('Slider')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function editSlider($data, $image = false)
    {

        global $db;

        if($image == "0"):

            $slider = $db->from('Slider')->where('id', $data['id'])->first();

            $data['image'] = $slider['image'];

        endif;

        $query = $db->update('Slider')
            ->where('id', $data['id'])
            ->set($data);

        if ($query):
            return true;
        endif;

    }

    public static function deleteSlider($data)
    {

        global $db;

        $query = $db->delete('Slider')
            ->where('id', $data)
            ->done();

        if ($query):
            return true;
        endif;

    }

}