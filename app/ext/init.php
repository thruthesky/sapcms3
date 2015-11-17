<?php
/**
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


