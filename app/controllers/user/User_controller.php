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


}

