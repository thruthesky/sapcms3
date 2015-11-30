<?php
/*
define('POST_CONFIG_TABLE', 'post_config');
define('POST_DATA_TABLE', 'post_data');
define('CONFIG_TABLE', 'config');
define('USER_TABLE', 'user');
define('DATA_TABLE', 'data');
define('MESSAGE_TABLE', 'message');//added by benjamin

define('DATA_PATH', 'data/');

define('ROOT_ID', 1);
define('ROOT_USERNAME', 'root');
define('ANONYMOUS_ID', 0);
define('ANONYMOUS_USERNAME', 'anonymous');
define('COOKIE_ID', 'id_user');

date_default_timezone_set( 'Asia/Seoul' );

*/
/**
 * @file sapcms3_function.php
 * @description
 *      - It includes basic function for sapcms3.
 *      - It is loaded very first of index.php
 *
 */

/**
 * Get list of controllers, models, themes.
 */
/*
$_list_controller = [];
$_list_theme = [];
$_list_model = [];
$_list_error = [];
*/
/*
function setControllers( $list ) {
    global $_list_controller;
    $_list_controller = $list;
}
*/
/*
function & getControllers( ) {
    global $_list_controller;
    return $_list_controller;
}
*/
/*
function setModels( $list ) {
    global $_list_model;
    $_list_model = $list;
}
function & getModels( ) {
    global $_list_model;
    return $_list_model;
}
*/
/*

function setThemes( $list ) {
    global $_list_theme;
    $_list_theme = $list;
}
function & getThemes( ) {
    global $_list_theme;
    return $_list_theme;
}
*/


/**
 *
function di($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

 */

/**
 * @param $plain_text_password
 * @return string
 */
/*
function encrypt_password($plain_text_password) {
    return password_hash($plain_text_password, PASSWORD_DEFAULT);
}

function check_password($plain_text_password, $hash) {
    return password_verify($plain_text_password, $hash);
}
*/


/*
function setError($message) {
    global $_list_error;
    $_list_error[] = $message;
}
function getError() {
    global $_list_error;
    return $_list_error;
}

function is_email($str) {
    return filter_var($str, FILTER_VALIDATE_EMAIL);
}
*/

/*



function debug_log($str) {
    static $count_debug_log = 0;
    $str = is_string($str) ? $str : print_r( $str, true );

    $count_debug_log ++;
    $str = "[$count_debug_log] $str\n";
    $fd = fopen('debug.log', 'a+');
    fwrite($fd, $str);
    fclose($fd);

}

function is_command_line_interface() {
    return (php_sapi_name() === 'cli' OR defined('STDIN'));
}
*/