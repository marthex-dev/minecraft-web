<?php


class store
{

    public static function addProducts($data)
    {

        global $db;

        $query = $db->insert('Products')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function updateProducts($data)
    {

        global $db;

        $query = $db->update('Products')
            ->where('id', $data['id'])
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function getProducts($data = false)
    {

        global $db;

        if ($data != false):
            
            $total = $db->from('Products')->join('Servers', 'Servers.id = Products.serverID')->join('ProductsCategories', 'ProductsCategories.id = Products.categoryID')->like('heading', $data)->select('count(*) as total')->total();

            if ($total > 0):
                
                $query = $db->from('Products')
                            ->join('Servers', 'Servers.id = Products.serverID')
                            ->join('ProductsCategories', 'ProductsCategories.id = Products.categoryID')
                            ->select('Products.*, Servers.heading as serverName, ProductsCategories.heading as CategoryName')
                            ->orderby('Products.id', 'DESC')
                            ->like('Products.heading', $data)
                            ->all();

                if ($query):
                    
                    return $query;

                else:

                    return false;

                endif;

            else:

                return false;

            endif;

        else:

            $total = $db->from('Products')->join('Servers', 'Servers.id = Products.serverID')->join('ProductsCategories', 'ProductsCategories.id = Products.categoryID')->select('count(*) as total')->total();

            if ($total > 0):
                
                $query = $db->from('Products')
                            ->join('Servers', 'Servers.id = Products.serverID')
                            ->join('ProductsCategories', 'ProductsCategories.id = Products.categoryID')
                            ->select('Products.*, Servers.heading as serverName, ProductsCategories.heading as CategoryName')
                            ->orderby('Products.id', 'DESC')
                            ->all();

                if ($query):
                    
                    return $query;

                else:

                    return false;

                endif;

            else:

                return false;

            endif;

        endif;

    }

    public static function getProductsInfo($data)
    {

        global $db;

        $total = $db->from('Products')->where('id', $data)->select('count(*) as total')->total();

        if ($total > 0):
            
            $query = $db->from('Products')->where('id', $data)->first();

            if ($query):
                
                return $query;

            else:

                return false;

            endif;

        else:

            return false;

        endif;

    }

    public static function deleteProducts($data)
    {

        global $db;

        $query = $db->delete('Products')
            ->where('id', $data)
            ->done();

        if ($query)
            return true;
        return false;

    }

    public static function addCategories($data)
    {

        global $db;

        $query = $db->insert('ProductsCategories')
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function updateCategories($data)
    {

        global $db;

        $query = $db->update('ProductsCategories')
            ->where('id', $data['id'])
            ->set($data);

        if ($query)
            return true;
        return false;

    }

    public static function deleteCategories($data)
    {

        global $db;

        $query = $db->delete('ProductsCategories')
            ->where('id', $data)
            ->done();

        if ($query)
            return true;
        return false;

    }

    public static function getServers()
    {

        global $db;

        $total = $db->from('Servers')->select('count(*) as total')->total();

        if ($total > 0):
            
            $query = $db->from('Servers')->all();

            if ($query):
                
                return $query;

            else:

                return false;

            endif;

        else:

            return false;

        endif;

    }

    public static function getCategories($data = 0, $type = 0)
    {

        global $db;

        if ($type==0):
            
            $total = $db->from('ProductsCategories')->join('Servers', 'Servers.id = ProductsCategories.serverID')->select('count(*) as total')->total();

        elseif ($type==1):

            $total = $db->from('ProductsCategories')->join('Servers', 'Servers.id = ProductsCategories.serverID')->where('ProductsCategories.serverID', $data)->select('count(*) as total')->total();

        elseif ($type==2):

            $total = $db->from('ProductsCategories')->join('Servers', 'Servers.id = ProductsCategories.serverID')->where('ProductsCategories.id', $data)->select('count(*) as total')->total();

        elseif ($type==3):

            $total = $db->from('ProductsCategories')->join('Servers', 'Servers.id = ProductsCategories.serverID')->like('ProductsCategories.heading', $data)->select('count(*) as total')->total();

        endif;


        if ($total > 0):
            
            if ($type==0):
            
                $query = $db->from('ProductsCategories')
                    ->join('Servers', 'Servers.id = ProductsCategories.serverID')
                    ->select('ProductsCategories.*, Servers.heading as serverName')
                    ->orderby('ProductsCategories.id', 'desc')
                    ->all();

            elseif ($type==1):

                $query = $db->from('ProductsCategories')->join('Servers', 'Servers.id = ProductsCategories.serverID')->select('ProductsCategories.*, Servers.heading as serverName')->where('ProductsCategories.serverID', $data)->all();

            elseif ($type==2):

                $query = $db->from('ProductsCategories')->join('Servers', 'Servers.id = ProductsCategories.serverID')->select('ProductsCategories.*, Servers.heading as serverName')->where('ProductsCategories.id', $data)->first();

            elseif ($type==3):

                $query = $db->from('ProductsCategories')
                    ->join('Servers', 'Servers.id = ProductsCategories.serverID')
                    ->select('ProductsCategories.*, Servers.heading as serverName')
                    ->orderby('ProductsCategories.id', 'desc')
                    ->like('ProductsCategories.heading', $data)
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

}