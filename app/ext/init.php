<?php

/**
 * Load Routes in each theme.
 */
foreach (glob(VIEWPATH . "*", GLOB_ONLYDIR) as $dir) {
    $path = "$dir/init.php";
    if ( file_exists($path) ) include $path;
}

$sys['theme'] = 'default';


function layout() {
    global $sys;
    return $sys['theme'] . '/layout';
}