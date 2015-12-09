<?php
$posts = post_data()->latest($o['post_config_name'], $o['limit']);
echo "<div class='posts $o[post_config_name]'>";
foreach( $posts as $post ) {
    $content = $post->get('content');
    if ( $url = $post->getFirstImageUrl() ) $img = "<img src='$url'>";
    else $img = null;
    echo "<div class='post'>$img$content</div>";
}
echo "</div>";
