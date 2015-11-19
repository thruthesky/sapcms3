<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Front extends MY_Controller
{
    public function index()
    {
        $data = [
            'page' => 'front',
        ];
        $this->render($data);
    }
}
