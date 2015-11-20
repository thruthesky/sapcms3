<?php
class TestData_controller extends MY_Controller
{
    public function index() {

        for( $i = 0; $i<111; $i++) {
            user()->create()
                ->set('username', "Username2-$i")
                ->setPassword("Username2-$i")
                ->set('email',  "user2-$i@gmail.com")
                ->set('address', "Block $i, Balibago, Angeles City, Pampanga")
                ->set('first_name', "First $i")
                ->set('last_name', "Last $i")
                ->save();
        }

        for( $i = 0; $i<111; $i++) {
            user()->create()
                ->set('username', "Yourname$i")
                ->setPassword("Yourname$i")
                ->set('email',  "name$i@gmail.com")
                ->set('address', "Block $i, Quezone City")
                ->set('first_name', "FName $i")
                ->set('last_name', "Lname $i")
                ->save();
        }

        echo "Done!";
    }
}