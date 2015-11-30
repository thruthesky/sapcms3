<?php
class PostConfig_test extends PostConfig {
    /**
     *
     */
    public function unitTest() {
        $this->postConfigExists();
        $this->createPostConfig();
    }

    private function createPostConfig() {


        $post_configs = $this->search([
            'where' => "name LIKE 'test%'",
        ]);
        $this->deleteEntities($post_configs);

        $username = 'test forum abc';
        user()->deleteByUsername($username);

        $user = user()->create()
            ->set('username', $username)
            ->save();


        $this->create()
            ->set('name', 'test')
            ->set('id_user', $user->get('id'))
            ->set('subject', 'Test Forum')
            ->set('description', 'This is test forum')
            ->save();


        $this->create()
            ->set('name', 'test2')
            ->set('subject', 'Test2 Forum')
            ->set('description', 'This is test forum')
            ->save();

        $this->unit->run( post_config( 'test2' )->get('name'), 'test2', "post_config() load test");


        $config = $this->loadBy('name', 'test');

        $user = $config->getUser();

        $this->unit->run($user->get('username'), $username, "Create PostConfig with username.");
        $this->unit->run($this->searchCount( ['where' => "name LIKE 'test%'"] ), 2, "Create PostConfig and count");



        $post_configs = $this->search([
            'where' => "name LIKE 'test%'",
        ]);
        $this->deleteEntities($post_configs);
        $this->unit->run($this->searchCount( ['where' => "name LIKE 'test%'"] ), 0, "Create PostConfig and count => 0");

        user()->deleteByUsername($username);
    }

    private function postConfigExists()
    {
        $this->unit->run($this->tableExists(), TRUE, $this->getTable() . ' table exists');
    }
}
