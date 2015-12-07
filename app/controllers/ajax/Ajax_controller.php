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

    public function page($name) {
        $render = ['page_name'=>$name];
        ob_start();
        widget('app_page_' . $name, $name);
        $markup = ob_get_clean();
        $render['md5'] = md5($markup);
        $render['html'] = $markup;
        $this->renderAjax($render);
    }

    public function widget($name) {
        $render = ['name'=>$name];
        ob_start();
        widget('app_'.$name);
        $markup = ob_get_clean();
        $render['html'] = $markup;
        $this->renderAjax($render);
    }
}