<?php
class Meta_test extends CI_Model {
    public function unitTest() {

        $this->load->library('unit_test');

        $meta = meta('temp_meta');
        if ( $meta->tableExists() ) {
            $meta->uninit();
        }
        $meta->init();
        $this->unit->run( $meta instanceof Meta, TRUE, 'meta instance of Meta');
        $this->unit->run( $meta instanceof Entity, TRUE, 'meta instance of Entity');

        $meta->create()->save();
        $this->unit->run( $meta->countAll(), 1, "Count temp_meta" );
        $meta->create()->set('code', 'ABC')->set('value', '123')->save();
        $this->unit->run( $meta->countAll(), 2, "Count temp_meta" );


        if ( $meta->load('ABC')->get('id') ) {
            $this->unit->run( $meta->get('code'), 'ABC', "loading ABC on this");
        }

        $item = $meta->load('ABC');
        if ( $item->get('id') ) {
            $this->unit->run( $meta->get('code'), 'ABC', "Loading ABC on new object (cloned)");
        }

        $meta->uninit();
    }
}