<?php

class news
{ 

	public static function addNews($data)
	{

		global $db;

        $query = $db->insert('News')->set($data);

        if ($query):
            return true;
        endif;

	}

	public static function editNews($data, $image = false)
	{

		global $db;

        if($image == "0"):

            $news = $db->from('News')->where('id', $data['id'])->first();

            $data['image'] = $news['image'];

        endif; 

		$query = $db->update('News')
            ->where('id', $data['id'])
            ->set($data);

        if ($query):
            return true;
        endif;

	}

	public static function deleteNews($data)
	{

		global $db;

		$query = $db->delete('News')
            ->where('id', $data)
            ->done();

        if ($query):
            return true;
        endif;

	}

    public static function getNews($data = false)
    {

        global $db;

        if ($data != false):

            $total = $db->from('News')
                        ->join('NewsCategory', 'NewsCategory.id = News.category')
                        ->join('Users', 'Users.id = News.accID')
                        ->where('News.heading', $data, 'LIKE')
                        ->or_where('NewsCategory.heading', $data, 'LIKE')
                        ->or_where('Users.username', $data, 'LIKE')
                        ->select('count(*) as total')
                        ->total();

        else:

            $total = $db->from('News')->join('NewsCategory', 'NewsCategory.id = News.category')->join('Users', 'Users.id = News.accID')->select('count(*) as total')->total();

        endif;

        if ($total > 0):

            if ($data != false):

                $query = $db->from('News')
                            ->join('NewsCategory', 'NewsCategory.id = News.category')
                            ->join('Users', 'Users.id = News.accID')
                            ->where('News.heading', $data, 'LIKE')
                            ->or_where('NewsCategory.heading', $data, 'LIKE')
                            ->or_where('Users.username', $data, 'LIKE')
                            ->select('News.heading as newsHeading, Users.id as UserID, NewsCategory.heading as categoryHeading, Users.username as username, News.id as id, News.views as views, News.commentsStatus as commentsStatus, News.creationDate as creationDate, News.slug')
                            ->orderby('News.id', 'desc')
                            ->all();


            else:

                $query = $db->from('News')
                            ->join('NewsCategory', 'NewsCategory.id = News.category')
                            ->join('Users', 'Users.id = News.accID')
                            ->select('News.heading as newsHeading, Users.id as UserID, NewsCategory.heading as categoryHeading, Users.username as username, News.id as id, News.views as views, News.commentsStatus as commentsStatus, News.creationDate as creationDate, News.slug')
                            ->orderby('News.id', 'desc')
                            ->all();

            endif;

            if ($query)
                return $query;
            return false;

        else:

            return false;

        endif;

    }

    public static function getNewsInfo($data)
    {

        global $db;

        $total = $db->from('News')->select('count(*) as total')->total();

        if ($total > 0):

            $query = $db->from('News')->where('id', $data)->first();

        endif;

    }

}

class newsCategory
{ 

    public static function addNewsCategory($data)
    {

        global $db;

        $query = $db->insert('NewsCategory')
            ->set(array(
                "slug" => $data['slug'],
                "heading" => $data['heading'],
                "color" => $data['color']
            ));

        if ($query):
            return true;
        endif;

    }

    public static function editNewsCategory($data)
    {

        global $db;

        $query = $db->update('NewsCategory')
            ->where('id', $data['id'])
            ->set([
                 'heading' => $data['heading'],
                 'slug' => $data['slug'],
                 "color" => $data['color'],
                 'updateDate' => date('Y-m-d H:i:s')
            ]);

        if ($query):
            return true;
        endif;

    }

    public static function deleteNewsCategory($data)
    {

        global $db;

        $query = $db->delete('NewsCategory')
            ->where('id', $data)
            ->done();

        if ($query):
            return true;
        endif;

    }

}

class NewsComments
{

    /**
     * @param $id
     * @return bool
     */

    public static function newsCommentsUpdate($id)
    {

        global $db;

        $query = $db->from('NewsComments')
            ->where('id', $id)
            ->first();

        if ($query['status']!=1):

            $commentsUpdate = $db->update('NewsComments')
                ->where('id', $id)
                ->set([
                    "status" => "1"
                ]);

        else:

            $commentsUpdate = $db->update('NewsComments')
                ->where('id', $id)
                ->set([
                    "status" => "0"
                ]);

        endif;

        if ($commentsUpdate)
            return true;
        return false;

    }

    /**
     * @param $id
     * @return bool
     */

    public static function newsCommentsDelete($id)
    {

        global $db;

        $query = $db->delete('NewsComments')
            ->where('id', $id)
            ->done();

        if ($query)
            return true;
        return false;

    }

}