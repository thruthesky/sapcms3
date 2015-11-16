<?php
class Meta extends Entity {

    public function __construct() {
        parent::__construct();
    }

    public function init() {
        parent::init();
        $this->load->dbforge();
        $fields = array(
            'code' => array(
                'type' => 'VARCHAR',
                'constraint' => 64,
            ),
            'value' => array(
                'type' => 'TEXT',
            ),
        );
        $this->dbforge->add_column($this->getTable(), $fields);
        return $this;

    }

    public function uninit() {
        entity($this->getTable())->uninit();
    }

    public function setTable($name) {
        $name = $name . '_meta';
        parent::setTable($name);
    }

}
