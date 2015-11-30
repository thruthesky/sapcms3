<?php
class Data_install extends Data
{
    public function __construct() {
        parent::__construct();
    }

    public function install() {
        $data = entity(DATA_TABLE)->init();
        $fields = array(
            'model' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),
            'type' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),
            'form_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),
            'id_entity' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'id_user' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'finish' => array(
                'type' => 'char',
                'constraint' => 1,
                'default' => 'N',
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'default' => '',
            ),
            'name_saved' => array(
                'type' => 'VARCHAR',
                'constraint' => 128,
                'default' => '',
            ),
            'mime' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),
            'size' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
        );

        $this->dbforge->add_column($data->getTable(), $fields);

        $this->db->query('ALTER TABLE `'. $data->getTable() .'` ADD INDEX `model` (`model`);');
        $this->db->query('ALTER TABLE `'. $data->getTable() .'` ADD INDEX `model_type` (`model`,`type`);');
        $this->db->query('ALTER TABLE `'. $data->getTable() .'` ADD INDEX `model_type_id_entity` (`model`,`type`,`id_entity`);');

    }

    public function uninstall() {
        if ( $this->tableExists() ) $this->uninit();
    }
}
