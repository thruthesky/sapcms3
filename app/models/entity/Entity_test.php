<?php
class Entity_test extends CI_Model {

    public function unitTest() {

        $this->load->library('unit_test');
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

}