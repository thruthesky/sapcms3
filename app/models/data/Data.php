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
class Data extends Node {

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

        debug_log("Data::upload($form_name, config, record)");

        $config = $this->get_upload_options ($config);
        debug_log("Data::upload() config");
        debug_log($config);
        $this->upload->initialize ( $config );

        if ( ! $this->upload->do_upload($form_name))
        {
            $error = $this->upload->display_errors('','');
            debug_log("ERROR: upload error: $error");
            return ['code'=>-1, 'message'=>$error];
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
            $uploaded = $this->createDataRecord( $record, $info);
            $data = data()->load( $uploaded->get('id') );
            return ['code'=>0, 'record'=>$data->getRecord()];
        }
    }

    private function createDataRecord($record, $info)
    {
        return data()->create()
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
