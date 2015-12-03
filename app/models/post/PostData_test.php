<?php
class PostData_test extends PostData {
    public function unitTest() {


        $this->testTree();

        $this->threadDeleteTest();

        $this->createPostData();
        $this->deleteTest();
    }

    private function testTree() {
        $config = post_config('FORUM');
        $id_config = $config->get('id');
        $root = post_data()
            ->create()
            ->set('id_config', $id_config)
            ->set('subject', 'root')
            ->save();
        $root->update('id_root', $root->get('id'));

        $c1 = post_data()->createComment($root->get('id'), 'comment 1');
        $c2 = post_data()->createComment($root->get('id'), 'comment 2');

        $rows = post_data()->getRecursiveTree($root->get('id'));
        $this->unit->run(count($rows), 2, "count tree");



        $c2_1 = post_data()->createComment($c2->get('id'), 'comment 2-1');
        $c2_1_1 = post_data()->createComment($c2_1->get('id'), 'comment 2-1-1');
        $c2_1_1_1 = post_data()->createComment($c2_1_1->get('id'), 'comment 2-1-1-1');


        $c2_2 = post_data()->createComment($c2->get('id'), 'comment 2-2');


        $rows = post_data()->getRecursiveTree($root->get('id'));
        $this->unit->run(count($rows), 6, "count tree 6");


        $rows = post_data()->getRecursiveTreeWithSelf($root->get('id'));
        $this->unit->run(count($rows), 7, "count tree 7");

        $rows = post_data()->getRecursiveTree($c2_2->get('id'));
        $this->unit->run(count($rows), 0, "count tree 0");

        $rows = post_data()->getRecursiveTree($c2_1->get('id'));
        $this->unit->run(count($rows), 2, "count tree 2");


        $c2_1_1_2 = post_data()->createComment($c2_1_1->get('id'), 'comment 2-1-1-2');
        $rows = post_data()->getRecursiveTree($c2_1->get('id'));
        $this->unit->run(count($rows), 3, "count tree 3");

    }

    private function threadDeleteTest() {

        $config = post_config('FORUM');
        $id_config = $config->get('id');
        $root = post_data()
            ->create()
            ->set('id_config', $id_config)
            ->set('subject', 'root subject')
            ->set('content', 'root content')
            ->save();
        $root->update('id_root', $root->get('id'));

        $this->unit->run( $root instanceof PostData, TRUE, "PostData instance test");

        // $parent->getComments();

        $this->unit->run( $root->countComment(), 0, "counting comment");

        $c1 = post_data()->createComment($root->get('id'), 'comment 1');
        $c2 = post_data()->createComment($root->get('id'), 'comment 2');
        $c3 = post_data()->createComment($root->get('id'), 'comment 3');
        $c4 = post_data()->createComment($root->get('id'), 'comment 4');
        $c5 = post_data()->createComment($root->get('id'), 'comment 5');

        $c2_1 = post_data()->createComment($c2->get('id'), 'comment 2-1');
        $c2_2 = post_data()->createComment($c2->get('id'), 'comment 2-2');
        $c2_1_1 = post_data()->createComment($c2_1->get('id'), 'comment 2-1-1');
        $c2_1_1_1 = post_data()->createComment($c2_1_1->get('id'), 'comment 2-1-1-1');

        $this->unit->run( $root->countComment(), 9, "counting comment 9");

        $c2_1_1->delete();
        $this->unit->run( $root->countComment(), 9, "counting comment 9 after delete a post");

        $c2_1_1_1->delete();
        $this->unit->run( $root->countComment(), 9, "counting comment 7 after delete a thread");

    }

    private function createPostData() {
        $post_data = post_data();
        $this->unit->run( $post_data instanceof PostData, TRUE, "PostData instance test");

        $post_data->create()
            ->set('subject', 'ABCD')
            ->set('content', '1234')
            ->save();

        $id = $post_data->get('id');

        $this->unit->run( post_data( $id )->get('subject'), 'ABCD', "post_data() : save & load & compare");

        $post_data->delete();
        $this->unit->run( post_data($id)->deleted(), TRUE, "Post Deleted");

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

        //$this->unit->run( post_data()->searchCount(['where'=>"id_config=$id_config"]), 0, "No item left after delete" );

    }
}
