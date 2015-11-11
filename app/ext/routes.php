<?php

/**
 * Load Routes in each controller.
 */
foreach (glob(APPPATH . "controllers/*", GLOB_ONLYDIR) as $filename) {
    $path = "$filename/Routes.php";
    if ( file_exists($path) ) include $path;
}

/**
 * Load Routes in each theme.
 */
foreach (glob(VIEWPATH . "*", GLOB_ONLYDIR) as $filename) {
    $path = "$filename/Routes.php";
    if ( file_exists($path) ) include $path;
}

