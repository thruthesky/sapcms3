<?php
define('POST_CONFIG_TABLE', 'post_config');
define('POST_DATA_TABLE', 'post_data');
define('CONFIG_TABLE', 'config');
define('USER_TABLE', 'user');

define('MESSAGE_TABLE', 'message');//added by benjamin


define('ROOT_ID', 1);
define('ROOT_USERNAME', 'root');
define('ANONYMOUS_ID', 0);
define('ANONYMOUS_USERNAME', 'anonymous');

define('COOKIE_ID', 'id_user');



date_default_timezone_set( 'Asia/Seoul' );


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
$_list_controller = [];
$_list_theme = [];
$_list_model = [];
$_list_error = [];
function setControllers( $list ) {
    global $_list_controller;
    $_list_controller = $list;
}
function & getControllers( ) {
    global $_list_controller;
    return $_list_controller;
}

function setModels( $list ) {
    global $_list_model;
    $_list_model = $list;
}
function & getModels( ) {
    global $_list_model;
    return $_list_model;
}


function setThemes( $list ) {
    global $_list_theme;
    $_list_theme = $list;
}
function & getThemes( ) {
    global $_list_theme;
    return $_list_theme;
}


/**
 *
 */
function di($data) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


/**
 * @param $plain_text_password
 * @return string
 */
function encrypt_password($plain_text_password) {
    return md5($plain_text_password);
}

/**
 * Returns page no.
 *  if the input is not a number or less than 0, then it returns 0.
 * @param $no
 * @return int|string
 */
function page_no($no) {
    if ( ! is_numeric($no) ) return 0;
    else if ( $no < 0 ) return 0;
    else return -- $no;
}


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

function getBrowserID() {
    return '';
}
function getIP() {
    return '';
}

function getDomain() {
    $domain = $_SERVER['HTTP_HOST'];
    $domain = strtolower($domain);
    return $domain;
}

/**
 *
 * Returns Base Domain from a domain
 *
 * @warning This is not perfect but works very good.
 * @param $domain
 * @return string
 * @code
 *              echo getBaseDomain(getDomain());
echo getBaseDomain('www.english.co.kr') . '<hr>';
echo getBaseDomain('www.dogs.co.kr') . '<hr>';
echo getBaseDomain('abc.string.pe.kr') . '<hr>';
echo getBaseDomain('www.abc.co.kr') . '<hr>';
echo getBaseDomain('www.abc.com') . '<hr>';
echo getBaseDomain('www.thefun.com.ph') . '<hr>';
echo getBaseDomain('www.get.com') . '<hr>';
echo getBaseDomain('get.some.com') . '<hr>';
echo getBaseDomain('www.explode.net') . '<hr>';
echo getBaseDomain('parts.domain.org') . '<hr>';
 * @endcode
 */
function getBaseDomain($domain) {
    $domain = strtolower($domain);
    $domain = str_replace('www.', '', $domain);
    $ex = explode('.', $domain);
    $index = count($ex)-1;
    $parts = [];
    for( $i=$index; $i >=0 ; $i-- ) {
        $parts[] = $ex[$i];
        if ( strlen($ex[$i]) > 3 ) break;
    }
    $parts_re = array_reverse($parts);
    return implode('.', $parts_re);
}

function getUserAgent() {
    return '';
}


/**
 * @param $name
 * @param null $o
 */
function widget($name, $o=null) {
    global $_last_widget_name;
    $_last_widget_name = $name;
    include "widget/$name/$name.php";
}


/**
 *
 * @warning Use this function ONLY at the very first line of the widget PHP script.
 *      Or it will create error.
 *
 * @param $file
 * @return string
 */
function widget_css($file=null) {
    global $_last_widget_name;
    if ( empty($file) ) $file = $_last_widget_name;
    echo "<link href='/widget/$_last_widget_name/$file.css' rel='stylesheet'>";
}

function widget_js($file=null) {
    global $name;
    if ( empty($file) ) $file = $name;
    echo "<script type='text/javascript' src='/widget/$name/$file.js'></script>";
}


function errorBox($message) {
    widget('errorBox', $message);
}


