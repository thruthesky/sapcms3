<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_controller extends MY_Controller {

    function adminPage(){
		$this->render([
            'page'=>'front',
            'theme' => 'admin',
		]);
	}
}
