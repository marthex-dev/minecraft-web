<?php


class banned
{

    public static function getBannedUser($data = false, $type = 0)
    {

        global $db;

        if ($data != false && $type == 0):
            
            $total = $db->from('BannedUsers')->join('Users', 'Users.id = BannedUsers.accID')->select('count(*) as total')->total();

        elseif ($data != false && $type == 1):

            $total = $db->from('BannedUsers')->join('Users', 'Users.id = BannedUsers.accID')->like('Users.username', $data)->select('count(*) as total')->total();

        else:

            $total = $db->from('BannedUsers')->join('Users', 'Users.id = BannedUsers.accID')->select('count(*) as total')->total();

        endif;

        if ($total > 0):
            
            if ($data != false && $type == 0):
            
                $query = $db->from('BannedUsers')
                    ->where('BannedUsers.id', $data)
                    ->join('Users', 'Users.id = BannedUsers.accID')
                    ->select('BannedUsers.*, Users.username, Users.id as UserID')
                    ->first();

            elseif ($data != false && $type == 1):

                $query = $db->from('BannedUsers')
                    ->join('Users', 'Users.id = BannedUsers.accID')
                    ->select('BannedUsers.*, Users.username, Users.id as UserID')
                    ->like('Users.username', $data)
                    ->all();

            else:

                $query = $db->from('BannedUsers')
                    ->join('Users', 'Users.id = BannedUsers.accID')
                    ->select('BannedUsers.*, Users.username, Users.id as UserID')
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

    public static function addBannedUser($data)
    {

        global $db;

        $query = $db->insert('BannedUsers')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function updateBannedUser($data)
    {
        global $db;

        $total = $db->from('BannedUsers')->where('id', $data['id'])->select('count(*) as total')->total();

        if ($total > 0):
            
            $query = $db->update('BannedUsers')
            ->where('id', $data['id'])
            ->set($data);

            if ($query)
                return true;
            return false;
        
        else:

            return false;

        endif;

        
    }

    public static function deleteBannedUser($data)
    {

        global $db;

        $total = $db->from('BannedUsers')->where('id', $data)->select('count(*) as total')->total();

        if ($total > 0):
            
            $query = $db->delete('BannedUsers')
            ->where('id', $data)
            ->done();

            if ($query)
                return true;
            return false;
        
        else:

            return false;

        endif;

    }

}