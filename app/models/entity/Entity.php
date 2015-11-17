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

    /**
     * @return $this|void
     */
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


    public function unitTest() {
        echo "<b>Entity Unit Test</b><hr>";

        $this->load->library('unit_test');
        $entity = entity('temp_entity');
        $this->unit->run( $entity instanceof Entity, TRUE, 'Entity Instance Test');

        $entity->init();
        $entity->create()->save();
        $this->unit->run( $this->db->count_all($entity->getTable()), 1, 'Insert a row and Count' );

        $entities = $entity->loadAll();
        $this->unit->run( count($entities), 1, 'count entity', 'loadAll()');

        $entity2 = entity('temp_entity_2');
        $this->unit->run( $entity2 instanceof Entity, TRUE, 'Entity Instance Test');

        $entity2->init();
        $item1 = $entity2->create()->save();
        $item2 = $entity2->create()->save();

        $this->unit->run( $this->db->count_all($entity2->getTable()), 2, 'Entity Count All');


        $entity->uninit();
        $entity2->uninit();

    }

    /**
     * Returns $this after clearing the $this->record.
     *      - It clears $this->record to create another record.
     *          If it does not clear $this->record['id'],
     *              it will create error
     *              because on $this->save(), $this->record['id'] will be duplicated.
     * @return $this
     */
    public function create() {
        $this->record = [];
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


    public function load($id) {
        $query = $this->db->query('SELECT * FROM ' . $this->getTable() . " WHERE id=$id");
        $rows = $query->result_array();
        $this->record = $rows[0];
        return $this;
    }

    /**
     * Returns objects of all records.
     *
     * @return array
     *
     * @important @note
     *  - Using $this->load() and cloning here, it will return the Object of inherted class.
     *      For instance, if 'Config' object is calling this method, then all of the return object is Config object.
     *
     *
     * @code
     *      di( post_config()->loadAll() );     - returns PostConfig objects
     *      di( config()->loadAll() );          - returns Config Objects
     * @endcode
     */
    public function loadAll() {
        $these = [];
        $query = $this->db->query('SELECT id FROM ' . $this->getTable());
        foreach ( $query->result() as $row ) {
            $this->load($row->id);
            $these[] = clone $this;
        }
        return $these;
    }
}