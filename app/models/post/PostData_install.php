<?php
class PostData_install extends PostData
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
                'default' => 0,
            ),
            'id_user' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'id_root' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'id_parent' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'id_data' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'order_list' => array(
                'type' => 'DOUBLE',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'depth' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint' => 2,
                'default' => 0,
            ),
            'subject' => array(
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'default' => '',
            ),
            'content' => array(
                'type' => 'LONGTEXT',
            ),
            'content_stripped' => array(
                'type' => 'LONGTEXT',
            ),
            'content_type' => array(
                'type' => 'VARCHAR',
                'constraint' => 16,
                'default' => '',
            ),


            'id_browser' => array(
                'type' => 'VARCHAR',
                'constraint' => 32,
                'default' => '',
            ),
            'ip' => array(
                'type' => 'CHAR',
                'constraint' => 15,
                'default' => '',
            ),
            'domain' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),
            'user_agent' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => '',
            ),
            'no_view' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint' => 4,
                'default' => 0,
            ),
            'no_comment' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint' => 2,
                'default' => 0,
            ),
            'no_vote_good' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint' => 2,
                'default' => 0,
            ),
            'no_vote_bad' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint' => 2,
                'default' => 0,
            ),
            'no_report' => array(
                'type' => 'INT',
                'constraint' => 2,
                'default' => 0,
            ),
            'secret' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                'default' => '',
            ),
            'blind' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                'default' => '',
            ),
            'blind_reason' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => '',
            ),
            'block' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                'default' => '',
            ),
            'block_reason' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
                'default' => '',
            ),
            'delete' => array(
                'type' => 'CHAR',
                'constraint' => 1,
                'default' => '',
            ),
            'country' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),
            'province' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),
            'city' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'default' => '',
            ),

            'link' => array(
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'default' => '',
            )


            );


        /*
        for( $i = 1; $i <= 7; $i ++ ) {
            $fields["category_$i"] = [ 'type' => 'INT', 'unsigned' => TRUE, 'default' => 0 ];
        }

        for( $i = 1; $i <= 10; $i ++ ) {
            $fields["int_$i"] = ['type'=>'INT','unsigned'=>TRUE];
            $fields["char_$i"] = ['type'=>'CHAR','constraint'=>1];
            $fields["varchar_$i"] = ['type'=>'VARCHAR','constraint'=>255];
        }
        for( $i = 1; $i <= 5; $i ++ ) {
            $fields["text_$i"] = [ 'type' => 'LONGTEXT' ];
        }
        */

        $this->dbforge->add_column( $data->getTable() , $fields);
        $this->db->query('ALTER TABLE `'. $data->getTable() .'` ADD INDEX `id_config` (`id_config`);');
        $this->db->query('ALTER TABLE `'. $data->getTable() .'` ADD INDEX `id_root_order_list` (`id_root`, `order_list`);');
        $this->db->query('ALTER TABLE `'. $data->getTable() .'` ADD INDEX `id_data` (`id_data`);');

    }

    public function uninstall()
    {
        if ( $this->tableExists() ) $this->uninit();
    }
}