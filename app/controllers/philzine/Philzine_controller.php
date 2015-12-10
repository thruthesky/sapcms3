<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Philzine_controller extends MY_Controller {
    public function setup() {

        $root = user('root');

        foreach ( ['front', 'news', 'info', 'travel', 'photo', 'forum', 'buyandsell'] as $name ) {
            $post_config = post_config($name);
            if ( $post_config ) continue;
            post_config()->create()
                ->set('name', $name)
                ->set('id_user', $root->get('id'))
                ->set('subject', "$name page forum")
                ->set('description', "This is $name page forum")
                ->save();
        }



    }
}
