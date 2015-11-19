<?php
class PostConfig_install extends Entity
{

    public function __construct()
    {
        parent::__construct();
    }

    public function install()
    {
        $config = entity(TABLE_POST_CONFIG)->init();
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

    }

    public function uninstall()
    {
        if (entity('post_config')->tableExists()) entity('post_config')->uninit();
    }
}