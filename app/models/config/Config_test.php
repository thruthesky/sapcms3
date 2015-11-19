<?php
class Config_test extends Config {
    public function unitTest() {

        $this->load->library('unit_test');

        $config = config();

        $this->unit->run( $config instanceof Config, TRUE, 'config instance of Config');
        $this->unit->run( $config instanceof Meta, TRUE, 'config instance of Meta');
        $this->unit->run( $config instanceof Entity, TRUE, 'config instance of Entity');

        $this->unit->run( $config->tableExists(), TRUE, 'config table exists' );

        $item = $config->load('name4');

        if ( $item ) {
            $item->delete();
        }

        $config->set('name4', 'jaeho');
        $value = $config->get('name4');

        $config->delete();

        $this->unit->run( $value, 'jaeho', "Config get/set test");
    }
}