<?php
/**
 * @file init.php
 * @desc This script is loaded by core/Codeigniter.php
 *
 *
 *
 */

$uri = is_command_line_interface() ? 'Command Line Interface' : $_SERVER['REQUEST_URI'];
debug_log("init.php begins : " . $uri);

/**
 *
 * Load Routes in each theme.
 */
foreach ( getThemes() as $dir) {
    $path = "$dir/init.php";
    if ( file_exists($path) ) include $path;
}


setModels( glob(APPPATH . "models/*", GLOB_ONLYDIR) );
foreach ( getModels() as $dir) {
    $path = "$dir/Routes.php";
    if ( file_exists($path) ) include $path;
}


