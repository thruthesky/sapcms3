<?php
class PostData_install extends Entity
{

    public function __construct()
    {
        parent::__construct();
    }

    public function install()
    {
        $data = entity(POST_DATA_TABLE)->init();
        $fields = array(
            'id_config' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'index' => TRUE,
            ),
            'id_user' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
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
        $this->db->query('ALTER TABLE `'.POST_DATA_TABLE.'` ADD INDEX `id_config` (`id_config`);');

    }

    public function uninstall()
    {
        if (entity('post_data')->tableExists()) entity('post_data')->uninit();
    }
}