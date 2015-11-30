<?php
spl_autoload_register( function( $class ) {
    $path = null;
    if ( strpos($class, 'firebird') !== false ) {
        $arr = explode('\\', $class);
        $path = "app/ext/firebird/$arr[1].php";
        include $path;
    }
} );