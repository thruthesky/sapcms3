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

function layout() {
    return get_theme_name() . '/layout';
}



function widget($name) {
    return "widget/$name/$name.php";
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