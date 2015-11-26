<?php

/**
 * Returns a new 'Entity' object.
 *  - Meaning it creates a new object whenever it is called.
 * @param string $table
 * @return Entity
 */
function entity($table) {
    $ci = & get_instance();
    $entity = clone $ci->entity;
    $entity->setTable($table);
    return $entity;

    /*
    static $count_entity = 0;
    $temp = $table . ($count_entity ++);
    $ci = & get_instance();
    $ci->load->model('entity', $temp);
    $entity = $ci->$temp;
    $entity->setTable($table);
    return $entity;
    */
}


/**
 * Returns a new 'Meta' object.
 * @param $table
 * @return Meta
 */
function meta($table = null) {

    $ci = & get_instance();
    $meta = clone $ci->meta;
    if ( $table ) $meta->setTable($table);
    return $meta;

    /*
    static $count_meta = 0;
    $temp = $table . ($count_meta ++);
    $ci = & get_instance();
    $ci->load->model('meta', $temp);
    $meta = $ci->$temp;
    $meta->setTable($table);
    return $meta;
    */
}

/**
 *
 * Returns a Config object or the value of the Config item.
 *
 * @note It will return the value of the code IF the input $code is specified.
 *
 * @param null $code
 * @return Config|mixed
 */
function config($code=null) {
    $ci = & get_instance();
    $config = clone $ci->my_config;
    if ( $code ) return $config->get($code);
    return $config;

    /*
    static $count_config = 0;
    $temp = CONFIG_TABLE . '_' . ($count_config ++);
    $ci = & get_instance();
    $ci->load->model('config/config', $temp);
    return $ci->$temp;
    */
}


/**
 *
 * Returns a user object depending on the input $id.
 *
 * @param null $id
 *  - If the $id is a number, then it loads user by user id.
 *  - If the $id is an email, then it loads user by email address.
 *  - If else, it loads user by username.
 * @return User
 *
 * @example See User_test.php
 */
function user($id=null) {
    $ci = & get_instance();
    $user = clone $ci->user;
    if ( $id ) {
        if ( is_numeric($id) ) $user->load($id);
        else if ( is_email($id) ) $user->loadByEmail($id);
        else return $user->loadByUsername($id);
    }



    return $user;

    /*
    static $count_user = 0;
    $temp = USER_TABLE . '_' . ($count_user ++);
    $ci = & get_instance();
    $ci->load->model('user/user', $temp);
    return $ci->$temp;
    */
}




/**
 *
 * Returns a Post() object.
 *
 *
 * @return Post
 *
 * @warning Since post() returns only returns 'loaded Post object' by system,
 *      - it does not clone nor create a new object.
 *      - So, it should not use any state information. ( meaning all the method must return stateless information )
 *
 *
 */
function post() {
    $ci = & get_instance();
    $ci->load->model('post');
    return $ci->post;
}

/**
 *
 * Returns PostConfig object.
 * @note
 *      - It creates a new object on each call.
 *
 * @return PostConfig
 *
 *
 * @code
 *      post_config()           // returns PostConfig object
 *      post_config(1)          // returns PostConfig object by id
 *      post_config('abc')      // returns PostConfig object that holds 'abc' post config data.
 */
function post_config($id=null) {

    $ci = & get_instance();
    $config = clone $ci->postconfig;
    if ( $id ) {

        if ( is_numeric($id) ) $config->load($id);
        else $config->loadBy('name', $id);
    }
    return $config;


    /*
    static $count_post_config = 0;
    $temp = POST_CONFIG_TABLE . ($count_post_config ++);
    $ci = & get_instance();
    $ci->load->model('post/postconfig', $temp);
    $config = $ci->$temp;
    if ( $name ) {
        $config->loadBy('name', $name);
    }
    return $config;
    */
}

/**
 * Returns a new PostData object.
 * @param int $id
 * @return PostData
 */
function post_data($id=0) {
    $ci = & get_instance();
    $data = clone $ci->postdata;
    if ( $id ) {
        $data->load($id);
    }
    return $data;
}


/**
 * @param null $index
 * @return mixed
 *
 * @code
 *
 *      in('post_get');     - Get a variable of HTTP Request.
 *          examples)
 *                  echo in('mode');
 *
 *      in()->get('index')         - Short of $this->input->get()
 *      in()->post('index')        - Short of $this->input->post();
 *      in()->cookie('index')      - Short of $this->input->cookie();
 *      in()->server('index')      - Short of $this->input->server();
 * @endcode
 */
function in($index=null) {
    $ci = & get_instance();
    if ( $index ) return $ci->input->post_get($index);
    else return $ci->input;
}

/**
 *
 * Returns the basename of the paths
 *
 * @param $list
 *      - List of paths.
 *          input example)
                Array
                (
                    [0] => C:\work\www\sapcms3\app\models/entity
                    [1] => C:\work\www\sapcms3\app\models/meta
                    [2] => C:\work\www\sapcms3\app\models/post
                )
 * @return array
 *  Array
        (
            [0] => entity
            [1] => meta
            [2] => post
        )
 *
 * @code
 *          getDirNames( getThemes() );
 *          di(getDirNames(getModels()));
 * @endcode
 */
function getDirNames(&$list) {
    $new_list = [];
    di($list);
    foreach( $list as $dir ) {
        $new_list[] = pathinfo($dir, PATHINFO_BASENAME);
    }
    return $new_list;
}




function get_default_theme() {
    return 'default';
}

function get_theme_name() {
    return get_default_theme();
}

/**
 * Returns the path of theme script.
 *  - Returns the path of the current theme.
 *  - If there is not theme script in the current theme folder, then it returns the theme script in default theme folder.
 * @param $page
 * @param null $theme
 * @return string
 */
function get_theme_script($page) {
    $path = 'theme/' . get_theme_name() . "/page/$page.php";
    if ( ! file_exists($path) ) $path = 'theme/' . get_default_theme() . "/page/$page.php";
    return $path;
}

/**
 * Alias of get_theme_script()
 */
function theme_script($page) {
    return get_theme_script($page);
}


function theme_css($file) {
    $name = get_theme_name();
    return "<link href='/theme/$name/css/$file.css' rel='stylesheet'>";
}

function theme_js($file) {
    $name = get_theme_name();
    return "<script type='text/javascript' src='/theme/$name/js/$file.js'></script>";
}


function layout() {
    return get_theme_name() . '/layout';
}




function url_post_view($post) {
    if ( is_numeric($post) ) {
        $name = post_config()->getCurrent()->get('name');
        return "/$name/view/$post";
    }
    else if ( $post instanceof PostData ) {
        $name = post_config( $post->get('id_config') )->get('name');
        return "/$name/view/" . $post->get('id');
    }
    else {
        setError("url_post_list : Wrong input");
        return 'WRONG INPUT';
    }
}

function url_post_edit($data) {
    if ( is_string($data) ) return "/$data/edit";
    else if ( $data instanceof PostConfig ) {
        return '/' . $data->get('name') . '/edit';
    }
    else {
        setError("url_post_data : Wrong input");
        return '';
    }
}



function url_post_list($name = null) {
    if ( $name === null ) {
        return '/' . post_config()->getCurrent()->get('name') . '/list';
    }
    else if ( is_string($name) ) {
        return "/$name/list";
    }
    else if ( $name instanceof PostConfig ) {
        return '/' . $name->get('name') . '/list';
    }
    else return "WRONG-VALUE";
}



function url_post_setting($name = null) {
    if ( $name === null ) {
        return '/post/admin';
    }
    else if ( is_string($name) ) {
        return "/post/config/$name";
    }
    else if ( $name instanceof PostConfig ) {
        return '/post/config/' . $name->get('name');
    }
    else return "WRONG-VALUE";
}




/*added by benjamin*/
function message() {
    $ci = & get_instance();
    $ci->load->model('message');
    return $ci->message;
}



function bootstrap_css() {
    return '<link href="/etc/bootstrap/css/bootstrap.min.css" rel="stylesheet">';
}

function bootstrap_js() {
    return '<script src="/etc/bootstrap/js/bootstrap.min.js"></script>';
}

function jquery() {
    return <<<EOH
    <!--[if lt IE 9]>
	<script type='text/javascript' src='/etc/js/jquery/jquery-1.11.3.min.js'></script>
	<![endif]-->
	<!--[if gte IE 9]><!-->
	<script type='text/javascript' src='/etc/js/jquery/jquery-2.1.4.min.js'></script>
	<!--<![endif]-->
EOH;
}


/**
 *
 * Returns the field of logged in user.
 *
 * @param string $field
 * @return bool|mixed
 * @code
 *      echo login();
 * @endcode
 *
 * @note Must use "login()" to check if the user is logged or not.
 *      - You cannot use "login('username')" because it will return a username even if it is not logged in.
 *      - If the user did not logged in, Anonymous will be used instead.
 *
 */
function login($field='id') {
	//edited by benjamin... I get
	//Fatal error: Call to a member function get() on a non-object in C:\work\sapcms3\app\helpers\sapcms3_helper.php on line 395
	$user_current = user()->getCurrent();
	if( !empty( $user_current ) ) return $user_current->get($field);
	//return user()->getCurrent()->get($field);//original code here
}