<?php
class PostConfig_install extends PostConfig
{

    public function __construct()
    {
        parent::__construct();
    }

    public function install()
    {
        $config = entity(POST_CONFIG_TABLE)->init();
        $fields = array(
            'id_user' => array(
                'type' => 'CHAR',
                'constraint' => 15,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'unique' => TRUE,
            ),
            'subject' => array(
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
            'header_comment' => array(
                'type' => 'LONGTEXT',
            ),
            'footer_comment' => array(
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
            'widget_list' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
            ),
            'widget_view' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
            ),
            'widget_edit' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
            ),

        );

        $this->dbforge->add_column($config->getTable(), $fields);

        $this->create()
            ->set('name', 'test')
            ->set('subject', 'Test Forum')
            ->save();

    }

    public function uninstall()
    {
        if (entity('post_config')->tableExists()) entity('post_config')->uninit();
    }
}