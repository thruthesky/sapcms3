<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class PostTestData_controller extends MY_Controller
{

    public function testData() {

        if ( $config = post_config('testForum') ) {

        }
        else {
            $config = post_config()->create()
                ->set('name', 'testForum')
                ->set('id_user', user('root')->get('id'))
                ->set('subject', 'This is Test Forum')
                ->set('description', 'This is Test forum...')
                ->save();
            echo "testForum created<hr>";
        }

        for( $i=0; $i<200; $i++ ) {
            post_data()
                ->create()
                ->set('id_config', $config->get('id'))
                ->set('subject', "Subject $i")
                ->set('content', "Content $i<hr>How are you, JK$i")
                ->save();
        }
        echo "testForum Posts created";
    }

    public function testData_remove() {
        $post_config = post_config('testForum');
        $this->db->delete(POST_DATA_TABLE, ['id_config'=>$post_config->get('id')]);
        $post_config->delete();
    }

}