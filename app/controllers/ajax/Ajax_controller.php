<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Ajax_controller extends MY_Controller
{
    
    public function __construct() {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');

    }

    public function info() {
        $this->renderAjax(['name'=>'sapcms3 app']);
    }

    public function version() {
        $this->renderAjax([
            'version' => '2015-12-13-3',
        ]);
    }
    /*
    public function page($name) {
        $render = ['page_name'=>$name];
        ob_start();
        widget('app_page_' . $name, $name);
        $markup = ob_get_clean();
        $render['md5'] = md5($markup);
        $render['html'] = $markup;
        $this->renderAjax($render);
    }
    */

    public function widget($widget_name) {
        $render = ['code'=>0, 'widget'=>$widget_name];
        $widget_real_name = 'app-'.$widget_name;
        $dir_path = "widget/$widget_real_name";
        if ( is_dir($dir_path) ) {
            ob_start();
            widget($widget_real_name, $widget_name);
            $markup = ob_get_clean();
            $markup = "<div class='widget $widget_name'>$markup</div>";
        }
        else {
            $markup = "<b>Widget($widget_name) does not exits. $widget_name 위젯은 없습니다.</b>";
            $render['code'] = 404;
        }
        $render['html'] = $markup;
        $render['length'] = strlen($markup);
        $render['md5'] = md5($markup);
        $this->renderAjax($render);

    }

    public function endless() {
        $page_no = page_no( in('page_no') );
        $post_config_name = in('forum');


        include 'app/ext/firebird/DataLayer.php';
        include 'app/ext/firebird/EndLessForum.php';

        $forum = EndLessForum::load();
        $forum->postList($post_config_name, $page_no)->returnAjax();

    }
}