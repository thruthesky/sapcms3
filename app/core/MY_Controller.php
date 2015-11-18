<?php
class MY_Controller extends CI_Controller {
    public $data = [];
    public function __construct()
    {
        parent::__construct();
    }

    public function render($data=null) {
        if ( ! isset($data['title']) || empty($data['title']) ) $data['title'] = '';
        $this->data  = $data;
        $this->load->view( layout() );
    }
}
