<?php
foreach ( $entities as $name ) {
    echo "Meta Entity : <a href='/entity/$name/list'>$name</a>";

    $numrows = $name()->countAll();
    echo " ( $numrows )";

    echo "<hr>";
}