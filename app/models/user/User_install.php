<?php
class User_install extends Entity
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
                'constraint' => 64,
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
    }
    public function uninstall() {
        if ( entity(USER_TABLE)->tableExists() ) entity(USER_TABLE)->uninit();
    }
}
