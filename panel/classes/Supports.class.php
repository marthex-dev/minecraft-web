<?php


class support
{

    public static function getCategory($data = false)
    {

        global $db;

        if ($data != false):
            
            $total = $db->from('SupportCategory')->like('SupportCategory.heading', $data)->select('count(*) as total')->total();

        else:

            $total = $db->from('SupportCategory')->select('count(*) as total')->total();

        endif;

        if ($total > 0):

            if ($data != false):
            
                $query = $db->from('SupportCategory')->like('heading', $data)->all();

            else:

                $query = $db->from('SupportCategory')->all();

            endif;

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function getCategoryInfo($data)
    {

        global $db;

        $total = $db->from('SupportCategory')->where('id', $data)->select('count(*) as total')->total();

        if ($total > 0):

            $query = $db->from('SupportCategory')
                ->where('id', $data)
                ->first();

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function insertCategory($data)
    {

        global $db;

        $insert = $db->insert('SupportCategory')
            ->set($data);

        if ($insert)
            return true;
        return false;

    }

    public static function updateCategory($data)
    {

        global $db;

        $insert = $db->update('SupportCategory')
            ->where('id', $data['id'])
            ->set($data);

        if ($insert)
            return true;
        return false;

    }

    public static function removeCategory($data)
    {

        global $db;

        $query = $db->delete('SupportCategory')
            ->where('id', $data)
            ->done();

        if ($query)
            return true;
        return false;

    }

    public static function getCount($data)
    {

        global $db;

        if ($data == 0):
            
            $total = $db->from('SupportTickets')->where('SupportTickets.status', '5', '!=')->select('count(*) as total')->total();

        else:

            $total = $db->from('SupportTickets')->where('SupportTickets.status', $data)->select('count(*) as total')->total();

        endif;

        if ($total)
            return $total;
        return false;

    }

    public static function getTickets($data = false)
    {
        
        global $db;

        if ($data == 5):

            $total = $db->from('SupportTickets')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Users', 'Users.id = SupportTickets.accID')->join('Servers', 'SupportTickets.serverID = Servers.id')->where('SupportTickets.status', '5', '!=')->select('count(*) as total')->total();

        elseif ($data == 1 OR $data == 2 OR $data == 3 OR $data == 4):

            $total = $db->from('SupportTickets')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Users', 'Users.id = SupportTickets.accID')->join('Servers', 'SupportTickets.serverID = Servers.id')->where('SupportTickets.status', $data)->select('count(*) as total')->total();

        else:

            $total = $db->from('SupportTickets')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Users', 'Users.id = SupportTickets.accID')->join('Servers', 'SupportTickets.serverID = Servers.id')->where('SupportTickets.heading', $data, 'LIKE')->or_where('Users.username', $data, 'LIKE')->or_where('SupportCategory.heading', $data, 'LIKE')->select('count(*) as total')->total();

        endif;

        if ($total > 0):

            if ($data == 5):

                $query = $db->from('SupportTickets')
                    ->join('Users', 'Users.id = SupportTickets.accID')
                    ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                    ->join('Servers', 'SupportTickets.serverID = Servers.id')
                    ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, Users.username, Servers.heading as serverName')
                    ->where('SupportTickets.status', '5', '!=')
                    ->orderby('SupportTickets.updateDate', 'ASC')
                    ->all();
                
            elseif ($data == 1 OR $data == 2 OR $data == 3 OR $data == 4):

                $query = $db->from('SupportTickets')
                            ->join('Users', 'Users.id = SupportTickets.accID')
                            ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                            ->join('Servers', 'SupportTickets.serverID = Servers.id')
                            ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, Users.username, Servers.heading as serverName')
                            ->where('SupportTickets.status', $data)
                            ->orderby('SupportTickets.updateDate', 'ASC')
                            ->all();

            else:

                $query = $db->from('SupportTickets')
                            ->join('Users', 'Users.id = SupportTickets.accID')
                            ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                            ->join('Servers', 'SupportTickets.serverID = Servers.id')
                            ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, Users.username, Servers.heading as serverName')
                            ->where('SupportTickets.heading', $data, 'LIKE')
                            ->where('SupportTickets.status', '5', '!=')
                            ->or_where('Users.username', $data, 'LIKE')
                            ->where('SupportTickets.status', '5', '!=')
                            ->or_where('SupportCategory.heading', $data, 'LIKE')
                            ->where('SupportTickets.status', '5', '!=')
                            ->orderby('SupportTickets.updateDate', 'ASC')
                            ->all();

            endif;

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function getUserTickets($data)
    {

        global $db;

        $total = $db->from('SupportTickets')->join('Users', 'Users.id = SupportTickets.accID')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->join('Servers', 'SupportTickets.serverID = Servers.id')->where('SupportTickets.accID', $data)->select('count(*) as total')->total();

        if($total > 0):

            $query = $db->from('SupportTickets')
                ->join('Users', 'Users.id = SupportTickets.accID')
                ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                ->join('Servers', 'SupportTickets.serverID = Servers.id')
                ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, Users.username, Servers.heading as serverName')
                ->where('SupportTickets.accID', $data)
                ->where('SupportTickets.status', '5', '!=')
                ->orderby('SupportTickets.updateDate', 'ASC')
                ->all();

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function insertMessage($data)
    {

        global $db;

        $total = $db->from('SupportTickets')->where('id', $data['supportID'])->select('count(*) as total')->total();

        if ($total > 0):

            $insert = $db->insert('SupportMessages')
                ->set($data);

            if ($insert):
                
                $update = $db->update('SupportTickets')
                ->where('id', $data['supportID'])
                ->set('status', '2');

                if ($update):
                
                    return true;
                
                else:
                
                    return false;
                
                endif;

            else:

                return false;

            endif;

        else:

            return false;

        endif;

    }

    public static function removeTickets($data)
    {

        global $db;

        $total = $db->from('SupportTickets')->where('id', $data)->select('count(*) as total')->total();

        if ($total > 0):

            $update = $db->update('SupportTickets')
                ->where('id', $data)
                ->set('status', '5');

            $updateNotifications = $db->update('Notifications')->where('type', '1')->where('data', $data)->where('status', '1')->set(array('status' => '0'));

            if ($update)
                return true;
            return false;

        else:

            return false;

        endif;

    }

    public static function updateTickets($data)
    {

        global $db;

        $total = $db->from('SupportTickets')->where('id', $data['id'])->select('count(*) as total')->total();

        if ($total > 0):

            $update = $db->update('SupportTickets')
                ->where('id', $data['id'])
                ->set('status', $data['status']);

            if ($update)
                return true;
            return false;

        else:

            return false;

        endif;

    }

    public static function getTicketInfo($data)
    {

        global $db;

        $total = $db->from('SupportTickets')->join('Users', 'Users.id = SupportTickets.accID')->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')->where('SupportTickets.id', $data)->select('count(*) as total')->total();

        if($total > 0):

            $query = $db->from('SupportTickets')
                ->where('SupportTickets.id', $data)
                ->where('SupportTickets.status', '5', '!=')
                ->join('Users', 'Users.id = SupportTickets.accID')
                ->join('SupportCategory', 'SupportCategory.id = SupportTickets.categoryID')
                ->select('SupportTickets.id as id, SupportTickets.heading as heading, SupportCategory.heading as CategoryHeading, SupportTickets.updateDate as updateDate, SupportTickets.status as status, SupportTickets.creationDate as creationDate, Users.id as UserID, Users.username as Username')
                ->first();

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function getMessage($data)
    {

        global $db;

        $query = $db->from('SupportMessages')
            ->where('supportID', $data)
            ->join('Users', 'Users.id = SupportMessages.accID')
            ->select('Users.username, SupportMessages.message, SupportMessages.creationDate, Users.id')
            ->orderBy('SupportMessages.id', 'ASC')
            ->all();

        if($query)
            return $query;
        return false;

    }

    public static function getAnswers($data = false)
    {

        global $db;

        if ($data != false):

            $total = $db->from('SupportAnswers')->like('heading', $data)->select('count(*) as total')->total();

        else:

            $total = $db->from('SupportAnswers')->select('count(*) as total')->total();

        endif;

        if ($total > 0):

            if ($data != false):

                $query = $db->from('SupportAnswers')->like('heading', $data)->all();

            else:

                $query = $db->from('SupportAnswers')->all();

            endif;

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function getAnswerInfo($data)
    {

        global $db;

        $total = $db->from('SupportAnswers')->where('id', $data)->select('count(*) as total')->total();

        if ($total > 0):

            $query = $db->from('SupportAnswers')
                ->where('id', $data)
                ->first();

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function insertAnswers($data)
    {

        global $db;

        $insert = $db->insert('SupportAnswers')
            ->set($data);

        if ($insert)
            return true;
        return false;

    }

    public static function updateAnswers($data)
    {

        global $db;

        $total = $db->from('SupportAnswers')->where('id', $data['id'])->select('count(*) as total')->total();

        if ($total > 0):

            $update = $db->update('SupportAnswers')
                ->where('id', $data['id'])
                ->set($data);

            if ($update)
                return true;
            return false;

        else:

            return false;

        endif;

    }

    public static function removeAnswers($data)
    {

        global $db;

        $total = $db->from('SupportAnswers')->where('id', $data)->select('count(*) as total')->total();

        if ($total > 0):

            $query = $db->delete('SupportAnswers')
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