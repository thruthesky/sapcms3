<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class PostTestData_controller extends MY_Controller
{

    public function testData() {

        $this->forumCreateData('forum');
        $this->forumCreateData('front');
        $this->forumCreateData('life');

    }

    public function testData_remove() {
        $post_config = post_config('FORUM');
        $this->db->delete(POST_DATA_TABLE, ['id_config'=>$post_config->get('id')]);
        $post_config->delete();
    }

    private function forumCreateData($name)
    {
        $config = post_config($name);
        if ( $config->exists() ) {
        }
        else {
            $config = post_config()->create()
                ->set('name', $name)
                ->set('id_user', user('root')->get('id'))
                ->set('subject', "This is - $name - Forum")
                ->set('description', "This is - $name - Forum")
                ->save();
            echo "$name forum created<hr>";
        }

        for( $i=0; $i<100; $i++ ) {
            $p = [];
            $p['id_config'] = $config->get('id');
            $p['subject'] = "$name - Subject $i";
            $p['content'] = "$name - Content $i<hr>How are you, S.J. $i";
            post_data()->createPost($p);
        }
        echo "$name forum Posts created<hr>";
    }

}