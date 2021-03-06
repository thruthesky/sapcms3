<?php
/**
 * @file sapcms3_helper.php
 * @desc This script should holds only those function that are dependant on CodeIgniter.
 */


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
 *
 * @param null $id
 * @return Data
 *
 */
function data($id = null)
{
    $ci = & get_instance();
    $data = clone $ci->my_data;
    if ( $id ) $data->load($id);
    return $data;
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
 *      - Meaning, it reuses only one object.
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
 * @param null $default - is the default value t return when the actual value is empty.
 * @return mixed
 * @code
 *
 *      in('post_get');     - Get a variable of HTTP Request.
 *          examples)
 *                  echo in('mode');
 *
 *      in('id_parent', 0)          - returns 0 when in('id_parent') is empty.
 *      in()->get('index')         - Short of $this->input->get()
 *      in()->post('index')        - Short of $this->input->post();
 *      in()->cookie('index')      - Short of $this->input->cookie();
 *      in()->server('index')      - Short of $this->input->server();
 * @endcode
 */
function in($index=null, $default=NULL) {
    $ci = & get_instance();
    if ( $index ) {
        $v = $ci->input->post_get($index, $default);
        if ( empty($v) ) return $default;
        else return $v;
    }
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
    foreach( $list as $dir ) {
        $new_list[] = pathinfo($dir, PATHINFO_BASENAME);
    }
    return $new_list;
}


function get_default_theme_name() {
    return 'default';
    return 'philzine';
}

function get_theme_name() {	
    global $theme_name;		
    if ( empty($theme_name) ) return get_default_theme_name();
    else return $theme_name;
}

function set_theme($theme) {
    global $theme_name;
    $theme_name = $theme;
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
    if ( ! file_exists($path) ) $path = 'theme/' . get_default_theme_name() . "/page/$page.php";
    return $path;
}

/*
function get_theme_template($name) {
    $path = get_theme_template_path(get_theme_name(), $name);
    if ( ! file_exists($path) ) $path = get_theme_template_path(get_theme_name(), $name);
    return $path;
}
function get_theme_template_path($theme, $name) {
    return "theme/$theme/template/$name.php";
}
*/

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
        $post_data = post_data($post);
        $name = post_config($post_data->get('id_config'))->get('name');
        $url = "/$name/view/$post";
        return $url;
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
function url_post_view_comment($id_parent, $id_comment) {
    $url = url_post_view($id_parent);
    $url .= "#comment$id_comment";
    return $url;
}

function url_post_edit($data) {
    if ( is_string($data) ) return "/$data/edit";
    else if ( $data instanceof PostConfig ) {
        return '/' . $data->get('name') . '/edit';
    }
    else if ( $data instanceof PostData ) {
        $config = post_config($data->get('id_config'));
        return '/' . $config->get('name') . '/edit/' . $data->get('id');
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
/**
 * @return Message
 */
function message() {
    $ci = & get_instance();
    $ci->load->model('message');
    return $ci->message;
}



function bootstrap_css() {
    return '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css">';
}

function bootstrap_js() {
    return '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/js/bootstrap.min.js"></script>';
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


/**
 *
 * Returns CURLFile object based on the input file.
 *
 */
function get_CURLFileObject($file) {
    $ci = & get_instance();
    $ci->load->helper('file');
    return new CURLFile($file, get_mime_by_extension($file));
}


function get_current_model_name() {
    $ci = & get_instance();
    return $ci->uri->segment(1);
}


/*
*added by benjamin
*
*/

function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment

    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}