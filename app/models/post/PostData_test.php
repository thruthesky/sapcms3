<?php
class PostData_test extends PostData {
    public function unitTest() {
        $this->createPostData();
        $this->deleteTest();
    }

    private function createPostData() {
        $data = post_data();
        $this->unit->run( $data instanceof PostData, TRUE, "PostData instance test");

        $data = $data->create()
            ->set('subject', 'ABCD')
            ->set('content', '1234')
            ->save();

        $id = $data->get('id');

        $this->unit->run( post_data( $id )->get('subject'), 'ABCD', "post_data() : save & load & compare");

        $data->delete();
        $this->unit->run( post_data($id)->get('id'), 0, "Post Deleted");

    }

    private function deleteTest()
    {

        $config = post_config()->create()
            ->set('name', 'testFourm2')
            ->set('subject', 'Test Forum 2')
            ->set('description', 'This is test forum')
            ->save();

        $id_config = $config->get('id');

        post_data()->create()
            ->set('id_config', $id_config)
            ->set('subject', 'ABCD')
            ->set('content', '1234')
            ->save();
        post_data()->create()
            ->set('id_config', $id_config)
            ->set('subject', 'Apple')
            ->set('content', 'Sweet')
            ->save();
        post_data()->create()
            ->set('id_config', $id_config)
            ->set('subject', 'Banana')
            ->set('content', 'Full')
            ->save();

        $posts = post_data()->rows("id_config=$id_config");




        $this->unit->run(count($posts), 3, "Counting posts");
        $this->unit->run( count($posts), post_data()->searchCount(['where'=>"id_config=$id_config"]), "Item count" );

        $items = post_data()->query_loads("id_config=$id_config");
        post_data()->deleteEntities($items);;
        $config->delete();

        $this->unit->run( post_data()->searchCount(['where'=>"id_config=$id_config"]), 0, "No item left after delete" );

    }
}
