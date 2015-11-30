<?php
/**
 * Class Data
 *
 *
 * @note It does not support Array like $_FORM['file[]'] variables.
 *          - It is actually useless.
 *              -- on mobile, no one do this.
 *              -- safari does not support multiple file uploads.
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
     * @param array $record
     * @return array
     */
    public function upload($form_name, $config, $record=[]) {

        $config = $this->get_upload_options ($config);
        $this->upload->initialize ( $this->get_upload_options ($config) );

        if ( ! $this->upload->do_upload($form_name))
        {
            $error = $this->upload->display_errors('','');
            return ['result'=>FALSE, 'error'=>$error];
        }
        else
        {
            $info = $this->upload->data();
            $record['form_name'] = $form_name;
            if ( ! isset($record['model']) ) $record['model'] = get_current_model_name();
            if ( ! isset($record['category']) ) $record['category'] = in('category', '');
            if ( ! isset($record['id_entity']) ) $record['id_entity'] = in('id_entity', 0);
            if ( ! isset($record['id_user']) ) $record['id_user'] = user()->getCurrent()->get('id');
            if ( ! isset($record['finish']) ) $record['finish'] = in('finish', 0);
            $this->createDataRecord( $record, $info);
            return ['result'=>TRUE, 'info'=>$info];
        }

    }

    private function createDataRecord($record, $info)
    {
        data()->create()
            ->sets($record)
            ->set('name', $info['client_name'])
            ->set('name_saved', $info['file_name'])
            ->set('mime', $info['file_type'])
            ->set('size', round($info['file_size'] * 100))
            ->save();
    }





    public function get_upload_options(&$config) {
        $config ['upload_path'] = DATA_PATH;
        $config ['allowed_types'] = 'gif|jpg|png';
        $config ['encrypt_name'] = TRUE;
        return $config;
    }

    /**
     * @deprecated Do not support array-var-uploads.
     *
     * Uploads array of files based on the $_FILE
     *
    public function upload_array($form_name) {

        $files = $_FILES;

        $count_upload_files = count ( $_FILES [$form_name]['name'] );
        for($i = 0; $i < $count_upload_files; $i ++) {
            $_FILES ['file'] ['name'] = $files [$form_name] ['name'] [$i];
            $_FILES ['file'] ['type'] = $files [$form_name] ['type'] [$i];
            $_FILES ['file'] ['tmp_name'] = $files [$form_name] ['tmp_name'] [$i];
            $_FILES ['file'] ['error'] = $files [$form_name] ['error'] [$i];
            $_FILES ['file'] ['size'] = $files [$form_name] ['size'] [$i];
            $this->upload->initialize ( $this->get_upload_options () );
            $this->upload->do_upload ('file');
        }
    }
     *
     */


    /**
     * Backward Overriding
     * @param $id
     * @return Entity
     */
    public function load($id) {
        parent::load($id);
        if ( $this->exists() ) {
            $this->set('url', base_url(DATA_PATH . $this->get('name_saved')));
        }
        return $this;
    }



}
