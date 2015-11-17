<?php
define('TABLE_POST_CONFIG', 'post_config');
define('TABLE_POST_DATA', 'post_data');
define('TABLE_CONFIG', 'config');



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