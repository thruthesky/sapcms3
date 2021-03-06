<?php
class Meta_test extends Meta {
    public function unitTest() {

        $this->testMetaCRUD();
        $this->testMetaDuplication();
        $this->testSearch();

    }

    private function testMetaCRUD()
    {
        $meta = meta('temp_meta_crud');
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

        $meta->create()
            ->set('code', 'apple')
            ->set('value', 'delicious')
            ->save();

        $item = $meta->loadBy('code', 'apple');


        $this->unit->run( $item->get('code'), 'apple', "Create() and check value");
        $this->unit->run( $item->get('value'), 'delicious', "Create() and check value");

        $item->set('value', 'sweet')->save();
        $this->unit->run( $item->get('value'), 'sweet', "Update value");


        $item->set('code', 'banana')->save();

        $item = $meta->loadBy('code', 'apple');
        $this->unit->run( $item, 'is_false', "Update code and load that item with previous code. result in FALSE.");

        $item = $meta->loadBy('code', 'banana');
        $this->unit->run( $item, 'is_object', "Update code and load that item with new code. result in object.");

        $this->unit->run( $item->get('code'), 'banana', "Update code");
        $this->unit->run( $item->get('value'), 'sweet', "Value");

        $meta->uninit();
    }

    private function testSearch()
    {

        $meta = meta('temp_meta_search');
        if ( $meta->tableExists() ) $meta->uninit();
        $meta->init();

        $meta->create()
            ->set('code', 'apple')
            ->set('value', 'sweet')
            ->save();

        $meta->create()
            ->set('code', 'banana')
            ->set('value', 'delicious')
            ->save();

        $meta->create()
            ->set('code', 'blueberry')
            ->set('value', 'sour')
            ->save();

        $meta->create()
            ->set('code', 'cherry')
            ->set('value', 'good')
            ->save();
        $meta->create()
            ->set('code', 'coconut')
            ->set('value', 'delicious')
            ->save();
        $meta->create()
            ->set('code', 'mango')
            ->set('value', 'sweet')
            ->save();
        $meta->create()
            ->set('code', 'melon')
            ->set('value', 'cool')
            ->save();



        $items = $meta->search();
        $this->unit->run(count($items), 7, "testSearch: counting = 7");

        $items = $meta->search([
            'from' => $meta->getTable(),
            'where' => "code like 'b%'",
        ]);
        $this->unit->run(count($items), 2, "testSearch: counting = 2");

        $meta->uninit();

    }

    private function testMetaDuplication()
    {

        $table = 'temp_meta_duplication';
        $meta = meta($table);
        if ( $meta->tableExists() ) {
            $meta->uninit();
        }

        $meta->init();

        $meta->create();
        $meta->set('code', 'A');
        $meta->set('value', 'apple');
        $meta->save();

        $meta2 = meta($table)->load('A');

        $this->unit->run($meta->get('code'), $meta2->get('code'), "Two same meta object");

        $meta2->set('code', 'B')->save();

        $this->unit->run($meta->get('code'), 'A', "Entity A");
        $this->unit->run($meta2->get('code'), 'B', 'Entity B');

        $meta3 = meta($table)->set('code', 'C')->set('value', '3')->save();

        $this->unit->run( $meta3->get('code'), 'C', "Meta Entity C");

        $this->unit->run( $meta->get('id') != $meta3->get('id'), TRUE, "Entity A and Entity B are not equal");


        $meta->uninit();

    }


}