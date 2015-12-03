<?php
class Config_test extends Config {
    /**
     *
     */
    public function unitTest() {
        $this->entityCheck();
        $this->crud();
        $this->configInterface();
    }

    private function crud()
    {
        $config = config();

        $this->unit->run( $config->tableExists(), TRUE, 'config table exists' );

        $item = $config->load('name4');

        if ( $item ) {
            $item->delete();
        }


        $config->set('name4', 'jaeho');
        $this->unit->run( $config->get('name4'), 'jaeho', "Config get/set test");

        $config->set('name4', 'you');
        $this->unit->run( $config->get('name4'), 'you', "Config update test");

        $config->delete();
    }

    private function entityCheck()
    {

        $config = config();

        $this->unit->run( $config instanceof Config, TRUE, 'config instance of Config');
        $this->unit->run( $config instanceof Meta, TRUE, 'config instance of Meta');
        $this->unit->run( $config instanceof Entity, TRUE, 'config instance of Entity');

    }

    private function configInterface()
    {

    }
}