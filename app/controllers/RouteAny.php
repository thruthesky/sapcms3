<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RouteAny extends My_Controller {
    public function load($page=null)
    {
        $this->render(['page'=>$page]);
    }
}
