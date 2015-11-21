<?php
define('POST_CONFIG_TABLE', 'post_config');
define('POST_DATA_TABLE', 'post_data');
define('CONFIG_TABLE', 'config');
define('USER_TABLE', 'user');



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