<?php
class PostData extends Post {

    private static $current = null;

    public function __construct() {
        parent::__construct();
        $this->setTable(POST_DATA_TABLE);
    }

    public function setCurrent($id) {

        if ( is_numeric($id) ) self::$current = $this->load($id);
        else if ( $id instanceof PostData ) self::$current = $id;
        else self::$current = null;

    }

    public function getCurrent() {

        if ( self::$current ) return self::$current;

        $mode = $this->uri->segment(2);
        if ( $mode == 'edit' || $mode == 'view' ) {
            $id = $this->uri->segment(3);
            $this->setCurrent($id);
        }
        else if ( in('id') ) {
            $this->setCurrent( in('id') );
        }

        return self::$current;
    }

    /**
     * Creates a post item from $this->input and returns the object.
     */
    public function createPostFromInput() {



        $record = [
            'id_config' => post_config()->getCurrent()->get('id'),
            'id_user' => user()->getCurrent()->get('id'),
            'id_parent' => in('id_parent'),
            'subject' => in('subject'),
            'content' => in('content'),
            'content_stripped' => strip_tags(in('content')),
            'content_type' => in('content_type'),
            'id_browser' => getBrowserID(),
            'ip' => getIP(),
            'domain' => getDomain(),
            'user_agent' => getUserAgent(),
            'country' => in('country'),
            'province' => in('province'),
            'city' => in('city'),
        ];
        for( $i=1; $i<=3; $i++ ) {
            $record["link_$i"] = in("link_$i");
        }
        for( $i=1; $i<=7; $i++ ) {
            $record["category_$i"] = in("category_$i");
        }
        for( $i=1; $i<=10; $i++ ) {
            $record["int_$i"] = in("int_$i");
            $record["char_$i"] = in("char_$i");
            $record["varchar_$i"] = in("varchar_$i");
        }
        for( $i = 1; $i <= 5; $i ++ ) {
            $record["text_$i"] = in("text_$i");
        }

        return $this->createPost($record);
    }


    /**
     * Creates a post data from the input array.
     *
     * @param $record
     * @return PostData
     */
    public function createPost($record) {

        if ( $record['id_parent'] ) {
            $parent = post_data($record['id_parent']);
            $record['id_root'] = $parent->get('idx_root');
        }

        $this->db->insert(POST_DATA_TABLE, $record);
        $id = $this->db->insert_id();
        return post_data($id);
    }




}