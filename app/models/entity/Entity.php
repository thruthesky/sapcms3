<?php
class Entity extends CI_Model {
    private $table;
    protected $record = [];
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function setTable($name) {
        $this->table = $name;
        return $this;
    }
    public function getTable() {
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

    /**
     *
     * Return TRUE if  the table of the Entity exists.
     *
     * @note It is an alias of $this->db->table_exists()
     *
     * @return mixed
     */
    public function tableExists() {
        return $this->db->table_exists($this->getTable());
    }



    /**
     *
     */
    public function uninit() {
        $this->load->dbforge();
        $this->dbforge->drop_table( $this->getTable() );
    }


    /**
     * Returns $this after clearing the $this->record.
     *      - Meaning you can call create() method as much time as you want on an Entity object.
     *      - It clears $this->record to create another record.
     *          If it does not clear $this->record['id'],
     *              it will create error
     *              because on $this->save(), $this->record['id'] will be duplicated.
     * @return $this
     *
     * @code Creating items on a single Entity object.
     *    $item1 = $entity2->create()->save();
     *    $item2 = $entity2->create()->save();
     * @endcode
     */
    public function create() {
        $this->record = [];
        self::set('created', time());
        self::set('updated', 0);
        return $this;
    }


    /**
     *
     * Saves or Updates an item.
     *
     * @note if it has value in $this->get('id'), then it updates.
     *
     * @return Entity|boolean
     *
     *      - FALSE if $this->record is empty.
     *
     */
    public function save() {

        if ( empty($this->record) ) return FALSE;

        if ( $id = self::get('id') ) {
            $this->db->where('id', $id);
            $this->db->update($this->getTable(), $this->record, ['id'=>$id]);
        }
        else {
            $this->db->insert($this->getTable(), $this->record);
            $this->record['id'] = $this->db->insert_id();
        }
        return $this;
    }

    /**
     *
     */
    public function delete() {
        $this->db->delete($this->getTable(), ['id'=>self::get('id')]);
        $this->record = [];
    }

    /**
     *
     *
     *
     * @note Use this method when you cannot use $this->set() directly for some inheritance reason.
     *
     * @param $field
     * @param $value
     * @return $this|Entity
     */
    public function set($field, $value) {
        $this->record[$field] = $value;
        return $this;
    }

    /**
     * Returns the value of the field in the item record.
     *
     *
     * @param $field
     * @return mixed|bool
     *      - returns FALSE if the field is not set.
     */
    public function get($field) {
        /**
        if ( isset($this->record[$field]) ) {
            return $this->record[$field];
        }
        */

        if (array_key_exists($field, $this->record)) {
            return $this->record[$field];
        }
        else {
            return FALSE;
        }
    }




    /**
     * Returns a new object of the Entity based on $id
     *
     * @note it actually loads a record into $this->record and return the clone.
     *
     * @param $id
     * @return Entity|FALSE - if there is no record, then it returns FALSE
     * - if there is no record, then it returns FALSE
     * @code
     *      $this->load(1)                                 // load by id
     * @endcode
     */
    public function load($id) {
        $query = $this->db->query('SELECT * FROM ' . $this->getTable() . " WHERE id=$id");
        $this->record = $query->row_array();
        if ( $this->record ) return clone $this;
        else return FALSE;
    }


    /**
     * Returns a new object of the Entity based on $field and $value
     *
     * @note it actually loads a record into $this->record and return the clone.
     * @note The input can be vary.
     *
     * @param $field
     * @param null $value
     * @return Entity|FALSE
     *      - if there is no record, then it returns FALSE
     *
     * @code
     *      $this->load(1)                                 // load by id
     *      $this->load('username', 'abc')                 // load by username
     *      $this->load('email', 'abc@gmail.com')        // load by email
     * @endcode
     */
    final public function loadBy($field, $value=null) {
        if ( $value === null ) {
            $value = $field;
            $field = 'id';
        }
        $query = $this->db->query('SELECT * FROM ' . $this->getTable() . " WHERE $field='$value'");
        $this->record = $query->row_array();
        if ( $this->record ) return clone $this;
        else return FALSE;
    }


    /**
     * Returns objects of all records of the table.
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

    /**
     * Returns the number of rows.
     *
     *      - It is only an alias of $this->db->count_all()
     * @return mixed
     */
    public function countAll() {
        return $this->db->count_all($this->getTable());
    }


    /**
     *
     * @param array $o
     *
     *  $o['from'] is the database. if it is not set, then it uses current Entity's database
     *
     * @return mixed
     */
    public function search($o=[]) {
        if ( isset( $o['from'] ) ) $this->db->from($o['from']);
        else $this->db->from($this->getTable());

        if ( isset($o['where']) ) $this->db->where($o['where']);
        return $this->db->get();
    }
}