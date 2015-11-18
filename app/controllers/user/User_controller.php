<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_controller extends MY_Controller {
    public function register()
    {
        $this->load->library('form_validation');
        $data = [
            'page' => 'user.register',
        ];

        $this->form_validation->set_rules(
            'email', 'Email',
            'trim|required|min_length[10]|max_length[64]|valid_email|is_unique[user.email]',
            array(
                'required'      => 'Please input your email address.',
                'is_unique'     => 'Email %s already exists.'
            )
        );


        $this->form_validation->set_rules('password', 'Password', 'required',
            array('required' => 'You must provide a %s.')
        );
        $this->form_validation->set_rules('password_confirm', 'Password Confirmation', 'trim|required|matches[password]');

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
        }
        else
        {
            $data['page'] = 'user.register_success';
        }
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

