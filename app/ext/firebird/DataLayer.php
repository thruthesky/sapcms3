<?php

class DataLayer {
    private $sys = null;
    //private $post_config = null;
    public function __construct () {
        global $sys;
        $this->sys = $sys;
    }
    protected function site() {
        return 'philzine';
    }
    protected function postSearch($o) {
        $limit = 5;
        $from = ($o['page_no']-1) * $limit;
        $post_config_name = $o['post_config_name'];
        $post_config = post_config($post_config_name);
        $list = post_data()->searchPost($post_config->get('id'), $limit, $from);
        $rows = [];
        if ( $list ) {
            foreach( $list as $post ) {
                $row = [];
                $row['subject'] = $post->get('subject');
                $row['content'] = $post->get('content');
                $row['username'] = $post->getUser()->get('name');
                $row['stamp_create'] = $post->get('stamp_create');
                $row['no_of_view'] = $post->get('no_view');
                $rows[] = $row;
            }
        }
        return $rows;
    }
}