<?php

use GuzzleHttp\Client;

defined('BASEPATH') OR exit('No direct script access allowed');
class Data_controller extends MY_Controller
{
    public function upload() {
        debug_log("Data_controller::upload() begins");
        //debug_log("_FILES");
        //debug_log($_FILES);




        if ( isset($_FILES['file']) ) {
            $upload = data()->upload('file', [
                'max_size' => 1000,
                'max_width' => 1024,
                'max_height' => 768,
            ]);
            if ( $upload['result'] === FALSE ) {
                debug_log("ERROR: ");
                debug_log($upload['error']);
            }
            else {
                debug_log("SUCCESS: ");
                debug_log($upload['data']);
            }
        }
        else {
            debug_log("ERROR: _FILE['file'] is not defined.");
        }

    }
}
