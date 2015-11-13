<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends MY_Controller {
    public function form()
    {
        $data = [
            'page' => 'user.register',
            'title' => 'This is title',
            'no' => [
                'No 1. Get the car',
                'No 2. Ride and Test the car',
            ]
        ];
        $this->render( $data );
    }
}

