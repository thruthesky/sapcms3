<?php

/**
 * Returns a new 'Entity' object.
 *  - Meaning it creates a new object whenever it is called.
 * @param string $table
 * @return Entity
 */
function entity($table) {
    static $count_entity = 0;
    $temp = $table . ($count_entity ++);
    $ci = & get_instance();
    $ci->load->model('entity', $temp);
    $entity = $ci->$temp;
    $entity->setTable($table);
    return $entity;
}


/**
 * Returns a new 'Meta' object.
 * @param $table
 * @return Meta
 */
function meta($table) {
    static $count_meta = 0;
    $temp = $table . ($count_meta ++);
    $ci = & get_instance();
    $ci->load->model('meta', $temp);
    $meta = $ci->$temp;
    $meta->setTable($table);
    return $meta;
}

/**
 * @return Config
 */
function config() {
    static $count_config = 0;
    $temp = CONFIG_TABLE . '_' . ($count_config ++);
    $ci = & get_instance();
    $ci->load->model('config/config', $temp);
    return $ci->$temp;
}


/**
 * @return User
 */
function user() {
    static $count_user = 0;
    $temp = USER_TABLE . '_' . ($count_user ++);
    $ci = & get_instance();
    $ci->load->model('user/user', $temp);
    return $ci->$temp;
}




/**
 * @return Post
 * @internal param null $id
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
 */
function post_config() {
    static $count_post_config = 0;
    $temp = 'post_config'. ($count_post_config ++);
    $ci = & get_instance();
    $ci->load->model('post/postconfig', $temp);
    return $ci->$temp;
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
