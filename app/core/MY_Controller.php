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

            $data['model'] = get_current_model_name();
        }
        $this->data  = $data;
        $this->load->view( layout(), $data );
        return null;
    }

    public function renderAjax($data) {
        echo json_encode($data);
        return null;
    }

    /*
    public function renderTemplate($name) {
        $path = get_theme_template($name);
        ob_start();
        include $path;
        $template = ob_get_clean();
        return $template;
    }
    */

}
