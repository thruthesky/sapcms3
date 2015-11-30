<?php
/**
 * @file init.php
 * @desc This script is loaded by core/Codeigniter.php
 *
 *
 *
 */

use firebird\FireBird;

$uri = FireBird::is_cli() ? 'Command Line Interface' : $_SERVER['REQUEST_URI'];
debug_log("init.php begins : " . $uri);

/**
 *
 * Load Routes in each theme.
 */
foreach ( FireBird::getThemes() as $dir) {
    $path = "$dir/init.php";
    if ( file_exists($path) ) include $path;
}


foreach ( FireBird::getModels() as $dir) {
    $path = "$dir/Routes.php";
    if ( file_exists($path) ) include $path;
}


