<?php

use GuzzleHttp\Client;

defined('BASEPATH') OR exit('No direct script access allowed');
class Data_controller extends MY_Controller
{
    public function upload() {
        debug_log("Data_controller::upload() begins");

        if ( isset($_FILES) && ! empty($_FILES) ) {

            $category = 'category.' . time();

            foreach( $_FILES as $form_name => $file_data ) {
                $upload = data()->upload($form_name, [
                    'max_size' => 1000,
                    'max_width' => 10240,
                    'max_height' => 7680,
                ],
                    [
                        'category' => $category
                    ]);
                if ( $upload['result'] === FALSE ) {
                    debug_log("ERROR: ");
                    debug_log($upload['error']);
                }
                else {
                    debug_log("SUCCESS: ");
                    debug_log($upload['info']);
                }
            }

            redirect( in('return_url') . '?category=' . $category);
        }
        else {
            debug_log("ERROR: _FILE['file'] is not defined.");
        }

    }

    public function ajaxUpload() {
        foreach( $_FILES as $form_name => $file_data ) {
            $upload = data()->upload($form_name, [
                'max_size' => 1000,
                'max_width' => 10240,
                'max_height' => 7680,
            ]);
            debug_log("Data::ajaxUpload()");
            debug_log($upload);
            $this->renderAjax($upload);
        }
    }
}
