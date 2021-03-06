<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User_controller extends MY_Controller {
	public function register()
	{
		$this->load->library('form_validation');
		$data = [
				'page' => 'user.register',
		];

        $user_table = user()->getTable();
		$this->form_validation->set_rules(
				'email', 'Email',
				'trim|required|min_length[10]|max_length[64]|valid_email|is_unique['.$user_table.'.email]',
				array(
						'required'      => 'Please input your email address.',
						'is_unique'     => 'Email %s already exists.'
				)
		);
		$this->form_validation->set_rules('password', 'Password', 'required',
				array('required' => 'You must provide a %s.')
		);
		
		//$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		//$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
		
		}
		else
		{		
			$data['user'] = self::create();
			$data['message'] = 'Register Successful!';
			//echo self::createNotice( $data['message'], true );
			//$data['page'] = 'user.register_success';
			user()->login( $data['user']->get('username') );			
		}
		
		$current_user = login();
		if( !empty( $current_user ) ) $data['user'] = user()->load( $current_user );
		$this->render( $data );
	}


    /**
     *
     *
     *
     * @return $this|Entity|FALSE
     */
	public function create() {		
		$request = $this->input->post();		
		if( empty( $request['id'] ) ) {
			$user = user()
					->create()
					->set( 'username', $request['username'] );					
		}
		else {
			$user = user()->load( $request['id'] );
			//if empty  $user error
		}

		if( !empty( $request['password'] ) ){
			$user->setPassword( $request['password'] );
		}
		if( !empty( $request['first_name'] ) ){
			$user->set( "first_name",$request['first_name'] );
		}
		if( !empty( $request['middle_name'] ) ){
			$user->set( "middle_name",$request['middle_name'] );
		}
		if( !empty( $request['last_name'] ) ){
			$user->set( "last_name",$request['last_name'] );
		}
		if( !empty( $request['address'] ) ){
			$user->set( "address",$request['address'] );
		}
		
		$user
				->set( 'email',  $request['email'] )
				//->set( 'first_name',  $request['first_name'] )
				//->set( 'middle_name',  $request['middle_name'] )
				//->set( 'last_name',  $request['last_name'] )
				//->set( 'address',  $request['address'] )
				->set( 'mobile',  $request['mobile'] )
				->save();

		//returns the user entity after create...
		return $user;
	}

	/**
	 *
	 */
	public function collection($offset=0) {			
		$k = in('keyword');
		$filter_by = in('filter_by');
		if( !empty( $filter_by ) ){
			$where = "$filter_by LIKE '%$k%'";
		}
		else{
			$where = "username LIKE '%$k%'
						OR email LIKE '%$k%'
						 OR first_name LIKE '%$k%'
						 OR middle_name LIKE '%$k%'
						 OR last_name LIKE '%$k%'
			";
		}

		$per_page = 10;

		$o = [
				'offset' => $offset,
				'limit' =>  $per_page,
			'where' => $where,
		];
		$users = user()->search($o);

		$total_rows = user()->searchCount($o);

		$data = [
				'page' => 'user.admin_list',
				'users' => $users,
				'total_row' => $total_rows,
				'per_page' => $per_page,
				'offset' => $offset,
				'keyword' => $k,
				'filter_by' => $filter_by,
		];

		$this->render( $data );
	}

	public function delete( $id ) {
		$user = user()->load( $id );
		$user->delete();
	}

	public function edit( $id ){
		$keyword = in('keyword');
		$offset = in('offset');
		$filter_by = in('filter_by');
	
		$user = user()->load( $id );		
		$data = [
				'page' => 'user.register',
				'user' => $user,
				'keyword' => $keyword,
				'offset' => $offset,
				'filter_by' => $filter_by,
		];
		$this->render( $data );
	}

	public function editSubmit()
	{
		$request = $this->input->post();
		if( empty( $request ) ){
			if( login() ) $redirect_url = "/user/edit";
			else $redirect_url = "/user/register";
			redirect( $redirect_url );
			exit;
		}
		//if empty request['id'] return
		$user = user()->load( $request['id'] );

		$this->load->library('form_validation');
		$data = [
				'page' => 'user.register',
				'user' => $user
		];
		
		$user_table = user()->getTable();
		
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
					'trim|required|min_length[10]|max_length[64]|valid_email|is_unique['.$user_table.'.email]',
					array(
							'required'      => 'Please input your email address.',
							'is_unique'     => 'Email %s already exists.'
					)
			);
		}
		
		if( !empty( $request['password'] ) ){
			$this->form_validation->set_rules('password', 'Password', 'required',
					array('required' => 'You must provide a %s.')
			);
		}
		
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{

		}
		else
		{
			$data['user'] = self::create();
			$data['message'] = 'Edit Successful!';
			//echo self::createNotice( $data['message'], true );
		}
		
		$this->load->helper('url');		
		//$redirect_url = "/user/list/".in('offset')."?keyword=".in('keyword');
		//$redirect_url = "/user/register";
		
		//redirect( $redirect_url );			
		$this->render( $data );		
	}


	public static function createNotice( $message, $successful = false ){
		if( $successful ){
			$class = ' success';
			$color = 'green';
		}
		else {
			$color = 'red';
		}

		return	"
				<div class='notice$class' style='padding:10px;;border:1px solid $color;background-color:#f7f7f7;color:$color;text-align:center;'>
					$message
				</div>
				";
	}

    public function login() {
        return $this->render(['page'=>'user.login']);
    }

    public function logout()
    {
        user()->logout();
        redirect(base_url());
    }

    /**
     * @return null
     */
    public function loginSubmit() {



        if ( $name = is_email(in('username')) ) {
            $user = user()->loadByEmail($name);
        }
        else {
            $name = in('username');
            $user = user()->loadByUsername($name);
        }

        if ( empty($user) ) {
            setError("User does not exists.");
            return $this->login();
        }

        if ( ! $user->checkPassword(in('password')) ) {
            setError("Password does not match");
            return $this->login();
        }

		$user->login();
		redirect(base_url());
    }

}

