<?php
class Message_install extends Message
{

    public function __construct()
    {
        parent::__construct();
    }

    public function install()
    {
        $message = entity(MESSAGE_TABLE)->init();
		
		$fields = array(
            'id_from' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
            'id_to' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
			'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 1024,
                'default' => '',
            ),
            'content' => array(
                'type' => 'LONGTEXT',
            ),
            'checked' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'default' => 0,
            ),
		);
		
		$this->dbforge->add_column($message->getTable(), $fields);
        $this->db->query('ALTER TABLE `'. $message->getTable() .'` ADD INDEX `id_from` (`id_from`);');
        $this->db->query('ALTER TABLE `'. $message->getTable() .'` ADD INDEX `id_to` (`id_to`);');
        $this->db->query('ALTER TABLE `'. $message->getTable() .'` ADD INDEX `id_from_id_to` (`id_from`,`id_to`);');
	}
	
	public function uninstall()
    {
        if ( $this->tableExists() ) $this->uninit();
    }
}