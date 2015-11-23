<?php
class User_test extends User {
    public function unitTest() {

        $this->load->library('unit_test');

        $this->testEntity();
        $this->testUserCreation();
        $this->testPassword();
        $this->testUserLoad();
        $this->testUserSearch();


    }

    private function testEntity()
    {/**
     * Entity check
     */
        $user = user();
        $this->unit->run( $user instanceof User, TRUE, 'user instance of User');
        $this->unit->run( $user instanceof Entity, TRUE, 'user instance of Entity');
        $this->unit->run( $user->tableExists(), TRUE, 'user table exists' );

    }

    private function testUserCreation()
    {


        /** User Creation Check by username */

        $name = "testUser-abc";
        user()->deleteByUsername($name);
        user()
            ->create()
            ->set('username', $name)
            ->save();
        $this->unit->run( $this->searchCount(['where'=>"username='$name'"]), 1, "testUserCreation ($name) count 1");
        user()->deleteByUsername($name);
        $this->unit->run( $this->searchCount(['where'=>"username='$name'"]), 0, "testUserCreation ($name) count 0");


        /** User Creation Check by Email */
        $email = "testUser-def@gmail.com";
        user()->deleteByEmail($email);
        user()->create()
            ->set('email', $email)
            ->save();
        $this->unit->run( $this->searchCount(['where'=>"email='$email'"]), 1, "testUserCreation ($email) count 1");

        $user = $this->create()
            ->set('email', $email . ".kr")
            ->save();

        $this->unit->run( $this->searchCount(['where'=>"email LIKE '$email%'"]), 2, "testUserCreation count 2");

        user()->deleteByEmail($email);
        $this->unit->run( $this->searchCount(['where'=>"email LIKE '$email%'"]), 1, "testUserCreation count 1 after delete 1");

        $user->delete();
        $this->unit->run( $this->searchCount(['where'=>"email LIKE '$email%'"]), 0, "testUserCreation count 0 after delete 1");

    }

    private function testPassword()
    {
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

        $user->set('username', 'song')->save();
        user()->login('song');
        $this->unit->run( user()->getCurrent()->get('email'), 'jaeho@gmail.com', "Username update test.");


        user()->loadByUsername('song')->set('username', 'Jae')->save();

        $email = user()->loadByUsername('Jae')->get('email');

        $this->unit->run($email, 'jaeho@gmail.com', 'User information update. jaeho@gmail.com');
        $user->delete();

    }

    private function testUserLoad()
    {
        user()->deleteByUsername('naver');
        user()->deleteByUsername('daum');
        user()->create()->set('username','naver')->set('email', 'naver@naver.com')->save();
        user()->create()->set('username', 'daum')->set('email', 'daum@hanmail.net')->save();

        $naver = user('naver')->login();
        $this->unit->run( $naver->get('id'), user('naver@naver.com')->get('id'), "User load test");
        $this->unit->run( user('daum@hanmail.net')->get('id'), user('daum')->get('id'), "User load test by username and email");


        user()->deleteByUsername('naver');
        user()->deleteByUsername('daum');
    }

    private function testUserSearch()
    {
    }
}