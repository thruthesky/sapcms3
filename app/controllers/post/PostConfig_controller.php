<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class PostConfig_controller extends MY_Controller
{

    public function collection()
    {
        return $this->render([
            'page' => 'post.config_list',
            'configs'=>post_config()->loadAll()
        ]);

    }

    public function createSubmit() {
        $name = in('name');

        if ( $config = post_config()->loadByName($name) ) {
            setError("Post config [ $name ] is already exists.");
        }
        else {

            post_config()->create()
                ->set('name', $name)
                ->save();
        }

        $this->collection();

    }

}