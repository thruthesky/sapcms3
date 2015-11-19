<?php
class User_test extends User {
    public function unitTest() {

        $this->load->library('unit_test');

        $user = user();

        $this->unit->run( $user instanceof User, TRUE, 'user instance of User');
        $this->unit->run( $user instanceof Entity, TRUE, 'user instance of Entity');

        $this->unit->run( $user->tableExists(), TRUE, 'user table exists' );




        $user = $this->create()
            ->set('email', 'thruthesky@gmail.com')
            ->save();



        $this->unit->run( $this->countAll(), 1, "count 1");

        $user->delete();

    }
}