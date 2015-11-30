<?php
/**
 *
 */
class MY_Controller extends CI_Controller {
    public $data = [];
    public function __construct()
    {
        parent::__construct();



    }


    /**
     *
     * @return null
     */
    public function render($data=null) {

        if ( is_array($data) ) {
            if ( ! isset($data['title']) ) $data['title'] = '';
            if ( isset($data['title'] ) ) {
                $data['path_theme_script'] = get_theme_script( $data['page'] );
            }
            $data['model'] = $this->uri->segment(1);
        }
        $this->data  = $data;
        $this->load->view( layout(), $data );
        return null;
    }

    public function renderAjax($data) {
        echo json_encode($data);
        return null;
    }
}
