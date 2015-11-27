<?php
class Entity_test extends CI_Model {

    public function unitTest() {
        $this->load->library('unit_test');
        $this->testCRUD();
        $this->testQuery();
        $this->testDelete();
    }

    private function testCRUD()
    {
        $entity = entity('temp_entity');
        if ( $entity->tableExists() ) {
            $entity->uninit();
        }

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
        $this->unit->run( $this->db->count_all($entity2->getTable()), 2, 'Entity Count All = 2');
        $item2->delete();
        $this->unit->run( $this->db->count_all($entity2->getTable()), 1, 'Entity Count All = 1');

        $entity->uninit();
        $entity2->uninit();

    }

    private function testQuery()
    {
        $entity = entity('temp_entity_query');
        if ( $entity->tableExists() ) {
            $entity->uninit();
        }
        $entity->init();

        $item1 = $entity->create()->save();
        $item2 = $entity->create()->save();
        $item3 = $entity->create()->save();

        $this->unit->run($entity->countAll(), 3, "count item 3");

        $this->unit->run( $entity->count('id<=2'), 2, "count item 2");

        $this->unit->run( $entity->result("created", "id=1"), $entity->load(1)->get('created'), "item create test" );


        $row = $entity->row("id=2");
        $this->unit->run( $entity->load(2)->get('id'), $row['id'], 'Row query test');

        $items = $entity->loads([1,2]);
        $this->unit->run( count($items), 2, "Rows Query Result Count");
        $this->unit->run( $items[0]->get('id'), $entity->load(1)->get('id'), "Rows Query");
        $this->unit->run( $items[1]->get('id'), $entity->load(2)->get('id'), "Rows Query");

        $items = $entity->query_loads("id<3");
        $this->unit->run( count($items), 2, "query_loads Result Count");
        $this->unit->run( $items[0]->get('id'), $entity->load(1)->get('id'), "query_loads test 1");
        $this->unit->run( $items[1]->get('id'), $entity->load(2)->get('id'), "query_loads test 2");


        $where = "id>1";
        $this->unit->run($entity->searchCount(['where'=>$where]), 2, "search count test");

        $items = $entity->search(['where'=>$where, 'order_by'=>'id DESC']);
        $this->unit->run(count($items), 2, "entity search count");
        $this->unit->run($items[0]->get('id'), 3, "entity search compare");




    }

    private function testDelete()
    {
        $entity = entity('entity_delete_test');
        if ( $entity->tableExists() ) {
            $entity->uninit();
        }
        $entity->init();
        $entity->create()->save();
        $entity->create()->save();
        $entity->create()->save();
        $entity->create()->save();

        $this->unit->run($entity->countAll(), 4, "entity count 4");

        $items = $entity->query_loads("id<3");
        $entity->deleteEntities($items);

        $this->unit->run($entity->countAll(), 2, "entity count 2");

        $this->unit->run($entity->load(1), FALSE, 'entity exists after delete');


    }


}