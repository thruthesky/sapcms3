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
                'unique' => TRUE,
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


    /**
     * Load an item by 'code' or 'id'
     * @param $id
     * @return $this|bool
     *  - returns FALSE If there is no record matching.
     */
    public function load($id) {
        if ( is_numeric($id) ) {
            $query = $this->db->query('SELECT * FROM ' . $this->getTable() . " WHERE id=$id");
            $this->record = $query->row_array();
        }
        else {
            $query = $this->db->query('SELECT * FROM ' . $this->getTable() . " WHERE code='$id'");
            $this->record = $query->row_array();
        }
        if ( $this->record ) return clone $this;
        else return FALSE;
    }

}
