<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Test_upload_controller extends MY_Controller
{
    public function test_upload_form() {
        $this->render(['page'=>'test_upload_form','error'=>'']);
    }
}
