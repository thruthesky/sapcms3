<?php



/**
 * Load Routes in each controller.
 */
setControllers( glob(APPPATH . "controllers/*", GLOB_ONLYDIR) );

foreach ( getControllers() as $filename) {
    $path = "$filename/Routes.php";
    if ( file_exists($path) ) include $path;
}


/**
 * Load Routes in each theme.
 */
setThemes( glob(VIEWPATH . "*", GLOB_ONLYDIR) );
foreach ( getThemes() as $filename) {
    $path = "$filename/Routes.php";
    if ( file_exists($path) ) include $path;
}


/**
 * Loads theme page.
 * #loading theme page directly
 */
$route['(:any)'] = 'route/route_controller/load/$1';


/**
 * Input extra routes here if any.
 */