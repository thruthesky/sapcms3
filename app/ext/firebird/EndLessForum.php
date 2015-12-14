<?php
class EndLessForum extends DataLayer {
    private $posts = [];
    private $page_no = null;
    private $post_config_name = null;
    public static function load() {
        return new EndLessForum();
    }
    public function postList($post_config_name, $page_no) {
        $this->post_config_name = $post_config_name;
        $this->page_no = $page_no;
        $this->posts = $this->postSearch([
            'post_config_name' => $post_config_name,
            'page_no' => $page_no,
        ]);
        return $this;
    }
    public function returnAjax() {
        echo json_encode([
            'code' => 0,
            'page_no' => $this->page_no,
            'forum' => $this->post_config_name,
            'site' => $this->site(),
            'posts' => $this->posts
        ]);
        exit;
    }
}