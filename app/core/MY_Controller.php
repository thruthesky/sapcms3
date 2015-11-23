<?php
class MY_Controller extends CI_Controller {
    public $data = [];
    public function __construct()
    {
        parent::__construct();
    }



    public function render($data=null) {
        if ( ! isset($data['title']) || empty($data['title']) ) $data['title'] = '';

        $this->path_theme_script = get_theme_script( $data['page'] );

        $this->data  = $data;
        $this->load->view( layout() );
    }
}
