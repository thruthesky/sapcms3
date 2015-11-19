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
			$data['user'] = self::create();			
			$data['message'] = 'Register Successful!';
			echo self::createNotice( $data['message'], true );
            //$data['page'] = 'user.register_success';
        }
        $this->render( $data );
    }

    public function create() {
		$request = $this->input->post();		
		if( empty( $request['id'] ) ) {
			$user = user()
					->create()
					->set( 'username', $request['username'] )
					->set( 'password',  $request['password'] );
		}
		else {
			$user = user()->load( $request['id'] );			
			//if empty  $user error			
		}
				
				$user
				->set( 'email',  $request['email'] )
				->set( 'first_name',  $request['first_name'] )
				->set( 'middle_name',  $request['middle_name'] )
				->set( 'last_name',  $request['last_name'] )
				->set( 'address',  $request['address'] )
				->set( 'mobile',  $request['mobile'] )
				->save();
		
		//returns the user entity after create...
		return $user;
    }

    /**
     *
     */
	public function collection() {
		$users = user()->loadAll();
		$data = [
            'page' => 'user.list',
			'users' => $users
        ];
		$this->render( $data );
	}
	
	public function delete( $id ){
		$user = user()->load( $id );
		$user->delete();
	}
	
	public function edit( $id ){
		$user = user()->load( $id );
		$user = $user;
		$data = [
            'page' => 'user.register',
            'user' => $user,
        ];		
		$this->render( $data );
	}
	
	 public function editSubmit()
    {
		$request = $this->input->post();
		
		//if empty request['id'] return
		$user = user()->load( $request['id'] );
	
        $this->load->library('form_validation');
        $data = [
            'page' => 'user.register',
			'user' => $user
        ];				
		
		if( $user->get('email') == $request['email'] ){
			//if email is the same don't validate email unique
			$this->form_validation->set_rules(
				'email', 'Email',
				'trim|required|min_length[10]|max_length[64]|valid_email',
				array(
					'required'      => 'Please input your email address.',
				)
			);
		}
		else{
			$this->form_validation->set_rules(
				'email', 'Email',
				'trim|required|min_length[10]|max_length[64]|valid_email|is_unique[user.email]',
				array(
					'required'      => 'Please input your email address.',
					'is_unique'     => 'Email %s already exists.'
				)
			);
		}
        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        if ($this->form_validation->run() == FALSE)
        {

        }
        else
        {
			self::create();
            $data['message'] = 'Edit Successful!';
			echo self::createNotice( $data['message'], true );
        }
        $this->render( $data );
    }
	
	
	public static function createNotice( $message, $successful = false ){
		if( $successful ){
			$class = ' success';
			$color = 'green';
		}
		else{
			$color = 'red';
		}
		
		return	"
				<div class='notice$successful' style='padding:10px;;border:1px solid $color;background-color:#f7f7f7;color:$color;text-align:center;'>
					$message
				</div>
				";
	}
}

