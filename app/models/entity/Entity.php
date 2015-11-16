<?php
class Entity extends CI_Model {
    private $table;
    private $record = [];
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function setTable($name) {
        $this->table = $name;
        return $this;
    }
    protected function getTable() {
        return $this->table;
    }
    public function init() {
        $this->load->dbforge();
        $this->dbforge->add_field('id');
        $fields = array(
            'created' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'updated' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
        );
        $this->dbforge->add_key('created');
        $this->dbforge->add_key('updated');
        $this->dbforge->add_field($fields);
        $this->dbforge->create_table( $this->getTable() );
        return $this;
    }
    public function uninit() {
        $this->load->dbforge();
        $this->dbforge->drop_table( $this->getTable() );
    }

    public function create() {
        $this->set('created', time());
        $this->set('updated', 0);
        return $this;
    }

    public function save() {
        $this->db->insert($this->getTable(), $this->record);
        $this->record['id'] = $this->db->insert_id();
        return $this;
    }

    public function set($field, $value) {
        $this->record[$field] = $value;
        return $this;
    }

    public function get($field) {
        return $this->record[$field];
    }

}