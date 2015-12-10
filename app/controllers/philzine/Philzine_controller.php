<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Philzine_controller extends MY_Controller {
    public function setup() {

        $root = user('root');

        foreach ( ['front', 'news', 'info', 'travel', 'photo', 'forum', 'buyandsell'] as $name ) {
            $config = post_config($name);
            if ( $config->exists() ) {

            }
            else {
                $config = post_config()->create()
                    ->set('name', $name)
                    ->set('id_user', $root->get('id'))
                    ->set('subject', "$name page forum")
                    ->set('description', "This is $name page forum")
                    ->save();
            }

            for( $i=0; $i<100; $i++ ) {
                $p = [];
                $p['id_config'] = $config->get('id');
                $p['subject'] = "$name - Subject $i";
                $p['content'] = "$name - Content $i<hr>How are you, S.J. $i";
                post_data()->createPost($p);
            }
        }

    }
}
