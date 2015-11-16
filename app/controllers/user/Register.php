<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends MY_Controller {
    public function form()
    {
        $data = [
            'page' => 'user.register',
            'title' => 'This is title',
            'no' => [
                'No 1. Get the car',
                'No 2. Ride and Test the car',
            ]
        ];
        $this->render( $data );
    }
    public function show() {
        $m = entity('meta');
        $m->set('c', 'd');
        print_r($m);
        echo '<hr>';

        $t = entity('test')
            ->set('t', 'test')
            ->set('j', 'jennifer');
        print_r($t);
        echo '<hr>';

        $m->set('j', 'jaeho song');
        print_r($m);
        echo '<hr>';

        $e = entity('edu');
        $e->set('e', 'education');
        $e->set('d', 'decipline');
        print_r($e);
        echo '<hr>';


        $m->set('name', 'SJ');
        print_r($m);
        echo '<hr>';

        $another = entity('test');
        $another->set('field', "This should be in another object");
        print_r($another);
        echo '<hr>';

        $t->set('AAA', '1234')
            ->set('BBB', '5555');
        print_r($t);
        echo '<hr>';
    }

    public function create() {

    }
}

