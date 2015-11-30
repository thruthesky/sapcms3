<?php
/**
 * @file routes.php
 * @desc This loads Routers.php of all controllers.
 */
use firebird\FireBird;



/**
 * Load Routes in each controller.
 */
foreach ( FireBird::getControllers() as $filename) {
    $path = "$filename/Routes.php";
    if ( file_exists($path) ) include $path;
}



/**
 * Input extra routes here if any.
 */

// -----------------------------------------------------------

/**
 * Loads theme page.
 * #loading theme page directly
 */
$route['(:any)'] = 'route/route_controller/load/$1';
