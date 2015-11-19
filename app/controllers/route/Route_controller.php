<?php
/**
 * @file Route_controller.php
 * @description This class is for helping "Routing"
 */

defined('BASEPATH') OR exit('No direct script access allowed');
class Route_controller extends My_Controller {

    /**
     * Loads theme page with layout.php
     *
     * @param null $page
     */
    public function load($page=null)
    {
        $this->render(['page'=>$page]);
    }
}
