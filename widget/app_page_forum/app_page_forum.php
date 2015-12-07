<?php

$ci = & get_instance();

$config_name = $o;
$config = post_config($config_name);
$per_page = $config->get('per_page');

$id_config = $config->get('id');
$where = "id_config=$id_config AND id_parent=0";
$list = post_data()->search([
    'where' => $where,
    'order_by' => 'id DESC',
    'offset' => 0,
    'limit' =>  10,
]);


debug_log("App Page : config_name: $config_name");

echo "<h2>App Page Forum</h2><hr>";

foreach ( $list as $post ) {

    echo "<div class='post'>";
    echo $post->get('content')."<br>";
    $files = $post->getFiles();
    if ( $files ) {
        $file = $files[0];
        echo $file->getImageBase64();
    }
    echo "</div>";
}

?>