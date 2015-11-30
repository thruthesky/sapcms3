<?php
class User_install extends User
{
    public function __construct() {
        parent::__construct();
    }

    public function install() {
        $user = entity(USER_TABLE)->init();
        $fields = array(
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'unique' => TRUE,
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
                'unique' => TRUE,
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'first_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 32,
            ),
            'middle_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 32,
            ),
            'last_name' => array(
                'type' => 'VARCHAR',
                'constraint' => 32,
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'mobile' => array(
                'type' => 'VARCHAR',
                'constraint' => 32,
            ),
        );
        $this->dbforge->add_column($user->getTable(), $fields);

        $this->create()
            ->set('username', ROOT_USERNAME)
            ->setPassword('1234')
            ->save();
        $this->db->query("UPDATE ". $this->getTable() ." SET id=".ROOT_ID." WHERE username='".ROOT_USERNAME."'");

        $this->create()
            ->set('username', ANONYMOUS_USERNAME)
            ->save();
        $this->db->query("UPDATE ". $this->getTable() ." SET id=".ANONYMOUS_ID." WHERE username='".ANONYMOUS_USERNAME."'");


    }

    public function uninstall() {
        if ( $this->tableExists() ) $this->uninit();
    }
}
