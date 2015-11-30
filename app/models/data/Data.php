<?php
/**
 * Class Data
 *
 *
 * @note It does not support multiple file uploads. It is actually useless.
 *          - on mobile, no one do this.
 *          - safari does not support multiple file uploads.
 *          -
 *
 *
 *
 */
class Data extends Entity {


    public function __construct()
    {
        parent::__construct();
        $this->setTable(DATA_TABLE);
        $this->load->library('upload');
    }


    /**
     * @param $form_name
     * @param $config
     * @return array
     */
    public function upload($form_name, $config) {

        $this->upload->initialize ( $this->get_upload_options ($config) );
        if ( ! $this->upload->do_upload($form_name))
        {
            $error = $this->upload->display_errors('','');
            return ['result'=>FALSE, 'error'=>$error];
        }
        else
        {
            $data = $this->upload->data();
            return ['result'=>TRUE, 'data'=>$data];
        }
    }

    public function get_upload_options(&$config) {
        $config ['upload_path'] = './data';
        $config ['allowed_types'] = 'gif|jpg|png';
        //$config ['encrypt_name'] = TRUE;
        return $config;
    }

    /**
     *
     * Uploads array of files based on the $_FILE
     *
     */
    public function upload_array($form_name) {

        $files = $_FILES;

        $count_upload_files = count ( $_FILES [$form_name]['name'] );
        for($i = 0; $i < $count_upload_files; $i ++) {
            $_FILES ['file'] ['name'] = $files [$form_name] ['name'] [$i];
            $_FILES ['file'] ['type'] = $files [$form_name] ['type'] [$i];
            $_FILES ['file'] ['tmp_name'] = $files [$form_name] ['tmp_name'] [$i];
            $_FILES ['file'] ['error'] = $files [$form_name] ['error'] [$i];
            $_FILES ['file'] ['size'] = $files [$form_name] ['size'] [$i];
            $this->upload->initialize ( $this->set_upload_options () );
            $this->upload->do_upload ('file');
        }
    }




}
