<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Test_controller extends MY_Controller
{

    public function index() {
        static $co = 0;
        foreach ( getModels() as $model ) {
            $name = pathinfo($model, PATHINFO_BASENAME);
            $path = "$name/" . ucfirst($name);
            $obj = $name . $co ++;
            $this->load->model($path, $obj);
            if ( method_exists( $this->$obj, 'unitTest') ) $this->$obj->unitTest();
        }

        echo $this->unit->report();
    }
}