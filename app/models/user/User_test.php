<?php
class User_test extends User {
    public function unitTest() {

        $this->load->library('unit_test');

        /**
         * Entity check
         */
        $user = user();
        $this->unit->run( $user instanceof User, TRUE, 'user instance of User');
        $this->unit->run( $user instanceof Entity, TRUE, 'user instance of Entity');
        $this->unit->run( $user->tableExists(), TRUE, 'user table exists' );


        /** User Creation Check by username */

        user()
            ->create()
            ->set('username', 'abc')
            ->save();
        $this->unit->run( $this->countAll(), 1, "count 1");
        user()->deleteByUsername('abc');
        $this->unit->run( $this->countAll(), 0, "count 0");


        /** User Creation Check by Email */
        user()->create()
            ->set('email', 'test@gmail.com')
            ->save();
        $this->unit->run( $this->countAll(), 1, "count 1");

        $user = $this->create()
            ->set('email', 'thruthesky@gmail.com')
            ->save();

        $this->unit->run( $this->countAll(), 2, "count 2");

        user()->deleteByEmail('test@gmail.com');
        $this->unit->run( $this->countAll(), 1, "count 1 after delete 1");

        $user->delete();
        $this->unit->run( $this->countAll(), 0, "count 0 after delete 1");

        /** User password check */
        user()->deleteByUsername('jaeho');
        user()->create()
            ->set('username', 'jaeho')
            ->setPassword('1234')
            ->set('email', 'jaeho@gmail.com')
            ->save();

        $user = user()->login('jaeho');
        $this->unit->run( user()->getCurrent()->get('username'), 'jaeho', "Login test - jaeho");
        $this->unit->run( user()->getCurrent()->get('email'), 'jaeho@gmail.com', "Login test - jaeho@gmail.com");

        user()->loginByEmail('jaeho@gmail.com');
        $this->unit->run( user()->getCurrent()->get('username'), 'jaeho', "Login test - jaeho");
        $this->unit->run( user()->getCurrent()->get('email'), 'jaeho@gmail.com', "Login test - jaeho@gmail.com");
        $user->delete();

    }
}