<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class PostData_controller extends MY_Controller
{

    public function collection($name)
    {

        $config = post_config($name);

        $this->render([
            'page' => 'post.list',
            'config' => $config,
        ]);

    }


    public function edit($name, $id = 0 ) {
        $config = post_config($name);
        $this->render([
            'page' => 'post.edit',
            'config' => $config,
        ]);
    }

    public function editSubmit() {

    }

}