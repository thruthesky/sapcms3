<?php
class PostData_test extends PostConfig {
    public function unitTest() {
        $this->createPostData();
    }

    private function createPostData() {


        $data = post_data();
        $this->unit->run( $data instanceof PostData, TRUE, "PostData instance test");

        $data = $data->create()
            ->set('subject', 'ABCD')
            ->set('content', '1234')
            ->save();



        $this->unit->run( post_data( $data->get('id') )->get('subject'), 'ABCD', "post_data() : save & load & compare");

    }
}
