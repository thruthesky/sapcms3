<?php
class PostData_install extends Entity
{

    public function __construct()
    {
        parent::__construct();
    }

    public function install()
    {
        $data = entity(TABLE_POST_DATA)->init();
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


    }

    public function uninstall()
    {
        if (entity('post_data')->tableExists()) entity('post_data')->uninit();
    }
}