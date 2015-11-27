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
            'id_parent' => in('id_parent', 0),
            'subject' => in('subject', ''),
            'content' => in('content', ''),
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

        $post = $this->createPost($record);
        $post->update('id_root', $post->get('id'));
        return $post;
    }


    /**
     * Creates a post data from the input array.
     *
     * @param $record
     * @return PostData
     */
    public function createPost($record) {
        if ( ! isset($record['created']) ) $record['created'] = time();
        $this->db->insert(POST_DATA_TABLE, $record);
        $id = $this->db->insert_id();
        return post_data($id);
    }



    /**
     *
     * Returns comments of 'id_root' or 'id_parent'
     *
     * @usage Use this method to retrieve comments of a post.
     *
     *
     * @param $id_root
     *      - is the original root post whose id_parent is 0
     * @return mixed
     *
     * @code To get current post's comment
     *      $comments = post_data()->getComments( post_data()->getCurrent()->get('id') );
     * @endcode
     *
     */
    public function getComments($id_root) {
        return $this->query_loads("id_root=$id_root AND id_parent>0 ORDER BY order_list ASC");
        //return self::getCommentsInOrder($id_root);
    }

    public function escapeContent($content)
    {
        $content = nl2br($content);
        return $content;
    }


    /**
     * Returns max order list value of the root and comments.
     * @param $id_root
     * @return mixed
     */
    private function maxOrderListOfRoot($id_root)
    {
        return post_data()->result("MAX(order_list)", "id_root=$id_root");
    }



    /**
     *
     * Returns the list of a tree based on $id_parent by Recursive call
     *
     * @param $id_parent
     * @param string $fields
     * @return array
     *
     * @code
     * print_r( post_data()->getRecursiveTree($post->get('id'), "idx, id_root, idx_parent, title, order_list"));
     * print_r( post_data()->getRecursiveTree($child1->get('id'), "idx, id_root, idx_parent, title, order_list"));
     * print_r( post_data()->getRecursiveTree($child2_1->get('id'), "id, id_root, id_parent, title, order_list"));
     * @endcode
     *
     */
    public function getRecursiveTree($id_parent, $fields='id, id_root, id_parent, depth, order_list') {
        $rows = $this->rows("id_parent=$id_parent", $fields);
        if ( $rows ) {
            foreach( $rows as $row ) {
                $ret = $this->getRecursiveTree($row['id'], $fields);
                $rows = array_merge($rows, $ret);
            }
        }
        return $rows;
    }


    /**
     * Returns the list of a tree including the post data of input parameter id.
     * @param $id
     * @param string $fields
     * @return array
     */
    public function getRecursiveTreeWithSelf($id, $fields='id, id_root, id_parent, depth, order_list') {
        $post = $this->row("id=$id", $fields);
        $rows = $this->getRecursiveTree($id, $fields);
        array_unshift($rows, $post);
        return $rows;
    }

    /**
     * Returns the MAX order_list among the children of parents.
     *
     * @param $id_parent
     * @return mixed
     */
    private function maxOrderListOfParent($id_parent)
    {
        $max = 0;
        $tree = self::getRecursiveTreeWithSelf($id_parent);
        if ( $tree ) {
            foreach ( $tree as $comment ) {
                if ( $comment['order_list'] > $max ) {
                    $max = $comment['order_list'];
                }
            }
        }
        return $max;
    }



    /**
     * @param $id_root
     * @param $order_list
     * @return mixed
     */
    private function nextOrderListOfRoot($id_root, $order_list)
    {
        return $this->result("order_list", "id_root=$id_root AND order_list>$order_list ORDER BY order_list ASC");
    }



    public function getListOrder(PostData &$parent)
    {
        $id_root = $parent->get('id_root');
        $id_parent = $parent->get('id');
        $count = $this->countComment($id_root);
        $newOrderList = 0;
        if ($count) {
            if ($id_root == $id_parent) { // first comment
                $max = self::maxOrderListOfRoot($id_root);
                $newOrderList = round($max + 2);
            }
            else if ($max = $this->maxOrderListOfParent($id_parent)) {
                if ($next = $this->nextOrderListOfRoot($id_root, $max)) {
                    if ($max == $next) {
                        //$next = self::nextOrderListOfRoot($id_root, $max);
                        echo "\nERROR: Post comment max and next are the same. Inform it to admin...\n";
                        exit;
                    }
                    else {
                        $newOrderList = ($max + $next) / 2;
                    }
                }
                else {
                    $newOrderList = round($max + 2);
                }
            }
            else {
                $newOrderList = 1;
            }
        }
        return $newOrderList;
    }
}