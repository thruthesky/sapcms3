<?php
class Post extends Entity {

    private $id = null;

    public function __construct() {
        parent::__construct();
    }
    public function init() {
        $config = entity('post_config')->init();
        $fields = array(
            'id_user' => array(
                'type' => 'CHAR',
                'constraint' => 15,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'description' => array(
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ),
            'top' => array(
                'type' => 'LONGTEXT',
            ),
            'bottom' => array(
                'type' => 'LONGTEXT',
            ),
            'header_list' => array(
                'type' => 'LONGTEXT',
            ),
            'footer_list' => array(
                'type' => 'LONGTEXT',
            ),
            'header_view' => array(
                'type' => 'LONGTEXT',
            ),
            'footer_view' => array(
                'type' => 'LONGTEXT',
            ),
            'header_edit' => array(
                'type' => 'LONGTEXT',
            ),
            'footer_edit' => array(
                'type' => 'LONGTEXT',
            ),
        );
        $this->dbforge->add_column($config->getTable(), $fields);

        $data = entity('post_data')->init();
        $fields = array(
            'id_user' => array(
                'type' => 'CHAR',
                'constraint' => 15,
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => 1024,
            ),
            'content' => array(
                'type' => 'LONGTEXT',
            ),
            'ip' => array(
                'type' => 'CHAR',
                'constraint' => 15,
            ),
            'user_agent' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
        );
        $this->dbforge->add_column($data->getTable(), $fields);

        $this->testInput();

        return $this;
    }
    public function uninit() {
        entity('post_config')->uninit();
        entity('post_data')->uninit();
    }

    private function testInput() {
        post_config()
            ->create()
            ->set('name', 'freetalk')
            ->set('description', 'This is a free talk forum.')
            ->save();
    }


    public function load($id) {

    }
}