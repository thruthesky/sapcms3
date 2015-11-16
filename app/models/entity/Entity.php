<?php
class Entity extends CI_Model {
    private $table;
    private $record = [];
    public function __construct() {
        parent::__construct();
    }
    public function table($name) {
        $this->table = $name;
    }
    public function create() {
        // @todo database table creation
        return $this;
    }
    public function set($field, $value) {
        $this->record[$field] = $value;
        return $this;
    }
    public function get($field) {
        //return $this->$fields[$field];
    }

}