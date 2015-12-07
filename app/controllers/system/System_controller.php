<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class System_controller extends MY_Controller {
    public function info()
    {

        $info = [];
        $info['php version'] = phpversion();
        $info['database'] = $this->db->platform();
        $info['database version'] = $this->db->version();
        $this->renderAjax($info);
    }

    public function phpinfo() {
        phpinfo();
    }
}

