<?php
class Entity extends CI_Model {
    private $table;
    protected $record = [];
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function setTable($name) {
        $this->table = $name . '_entity';
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
     *
     * @warning This method creates item but it does not CLONE it.
     *  So, if you use like below,
     *
            $item1 = $entity->create()->save();
            $item2 = $entity->create()->save();
            $item3 = $entity->create()->save();
     *
     * All the vars $item1, $item2, $item3 have same item.
     *
     */
    public function create()
    {
        return $this->reset();
    }

    /**
     * Resets the entity
     *
     * @return $this
     */
    private function reset() {
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
     * Updates a field of the entity.
     * @note Unlike $this->save(), this method only updates one(1) field.
     * @usage Use this method when you need to update a field immediately.
     * @note it updates $this->record after updating the database record field.
     * @param $field
     * @param $value
     * @return $this|bool
     */
    public function update($field, $value) {
        if ( $this->get('id') ) {
            $this->db->set($field, $value);
            $this->db->where('id', $this->get('id'));
            $this->db->update( $this->getTable());
            $this->set($field, $value);
            return $this;
        }
        else return FALSE;
    }

    /**
     *
     * Updates fields of the record.
     * @note This is an array version of $this->update()
     * @param $array
     * @return $this|bool
     */
    public function updates($array) {
        if ( $this->get('id') ) {
            foreach ( $array as $field => $value ) {
                $this->db->set($field, $value);
                $this->set($field, $value);
            }
            $this->db->where('id', $this->get('id'));
            $this->db->update( $this->getTable());
            return $this;
        }
        else return FALSE;
    }


    /**
     * Deletes the current Entity
     */
    public function delete() {
        $this->db->delete($this->getTable(), ['id'=>self::get('id')]);
        $this->record = [];
    }


    /**
     * Deletes Entities
     *
     *
     * @code
     *
     *      $items = post_data()->query_loads("id_config=$id_config");
            post_data()->deleteEntities($items);;
     * @endcode
     */
    public function deleteEntities($entities) {
        if ( empty($entities) ) return;
        foreach( $entities as $entity ) {
            $entity->delete();
        }
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
     *
     * It gets assoc-array to set $this->record
     *
     * @param $fields
     * @return $this
     */
    public function sets($fields) {
        $this->record = array_merge($this->record, $fields);
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

        if ( isset($this->record[$field]) ) {
            return $this->record[$field];
        }
        /*
        if (array_key_exists($field, $this->record)) {
            return $this->record[$field];
        }
        */
        else {
            return FALSE;
        }
    }

    /**
     * Returns $this->record
     * @return array
     *
     * @code
     * return ['result'=>0, 'record'=>$data->getRecord()];
     * @endcode
     */
    public function getRecord() {
        return $this->record;
    }




    /**
     * Returns a new object of the Entity based on $id
     *
     * @note it actually loads a record into $this->record and return the clone.
     *
     * @note if the input $id is 0, then it loads the entity of id with 0.
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
     *
     * Returns an array of Entity object.
     *
     * @param $ids
     * @return array
     */
    public function loads($ids) {
        $these = [];
        foreach ($ids as $id) {
            $entity = clone $this;
            $entity->load($id);
            $these[] = $entity;
        }
        return $these;
    }

    /**
     * Returns an array of Entity object based on the Query.
     *
     * @note
     *  - first, queries
     *  - and get the 'id's of the item
     *  - and loads it into array and return.
     *
     * @param $where
     * @return array
     *
     * @code
     *      return $this->query_loads("id_root=$id_root AND id_parent>0 ORDER BY order_list ASC");
     * @endcode
     */
    public function query_loads($where) {
        $query = $this->db->query("SELECT id FROM " . $this->getTable() . " WHERE $where");
        $ids = [];
        foreach ( $query->result() as $row ) {
            $ids[] = $row->id;
        }
        return $this->loads($ids);
    }



    /**
     * Returns a new object of the Entity based on $field and $value
     *
     * @note it actually loads a record into $this->record and return the clone.
     * @note The input can be vary.
     *
     * @param $field
     * @param null $value
     * @return $this|bool
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
     * Returns TRUE if the entity item is exists. or FALSE.
     * @return bool|mixed
     */
    public function exists() {
        return $this->get('id') > 0;
    }


    /**
     * Returns the number of record found by the $where query.
     * @param $where
     * @return mixed
     * @code
     * return post_data()->count("id_root=$id_root AND id_parent>0");
     * @endcode
     * @todo UnitTest
     */
    public function count($where) {
        return $this->result("COUNT(id)", $where);
    }

    /**
     * @param $field
     * @param $where
     * @return null
     * @todo UnitTest
     */
    public function result($field, $where) {
        $row = $this->row($where, $field);
        if ( $row ) {
            foreach( $row as $k => $v ) {
                return $v;
            }
        }
        return NULL;
    }

    /**
     * @param $where
     * @param string $select
     * @return null
     *
     * @code Getting the first row.
     *      $query = $entity->row();
     *      di($this->db->last_query());
     * @endcode
     */
    public function row($where=null, $select='*') {
        if ( empty($where) ) $where = '1';
        $rows = $this->rows($where . ' LIMIT 1', $select);
        if ( $rows ) {
            return $rows[0];
        }
        return NULL;
    }

    /**
     * @param null $where
     * @param string $select
     * @return mixed
     *
     * @todo UnitTest
     */
    public function rows($where=null, $select='*') {
        $table = $this->getTable();
        if ( $where ) $where = "WHERE $where";
        $query = $this->db->query("SELECT $select FROM $table $where");
        return $query->result_array();
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
     * $o['from'] is the database. if it is not set, then it uses current Entity's database
     * $o['offset'] is the offset to retrieve records.
     * $o['page'] is the page number to retrieve the block of record.
     * $o['limit'] is the number of records to retrieve.
     *      - @note you cannot use 'offset' and 'page' at the same time.
     *
     * $o['fields'] is the fields to retrieve. for instance, 'id, created'
     * $o['order_by'] is the same as CI3.
     *
     * @return mixed
     *
     *
     * @code
     * $users = user()->search([
     *    'page' => 1,
     *    'limit' =>  10,
     *    ]);
     * @endcode
     */
    public function search($o=[]) {

        if ( isset( $o['from'] ) ) $this->db->from($o['from']);
        else $this->db->from($this->getTable());
        $this->db->select('id');
        if ( isset($o['where']) ) $this->db->where($o['where']);

        if ( isset($o['order_by']) ) $this->db->order_by($o['order_by']);

        if ( isset($o['limit']) ) {
            if ( isset($o['offset']) ) {
                $this->db->limit($o['limit'], $o['offset']);
            }
            else if ( isset($o['page'] ) ) {
                $this->db->limit($o['limit'], $o['limit'] * page_no($o['page']) ) ;
            }
            else $this->db->limit($o['limit']);
        }


        $ids = [];
        $query = $this->db->get();
        foreach ( $query->result() as $row ) {
            $ids[] = $row->id;
        }
        return $this->loads($ids);

        /*

        $these = [];
        $query = $this->db->get();
        foreach ( $query->result() as $row ) {
            $this->load($row->id);
            $these[] = clone $this;
        }
        return $these;
        */
    }

    public function searchCount($o=[])
    {
        if ( isset( $o['from'] ) ) $this->db->from($o['from']);
        else $this->db->from($this->getTable());
        $this->db->select('id');
        if ( isset($o['where']) ) $this->db->where($o['where']);
        return $this->db->count_all_results();
    }




}