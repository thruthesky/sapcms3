<?php
$widget_name = $o;
?>

<style>
    .data img {
        width:100%;
    }
</style>

<div class="data">
    <h1>Life is nothing without adventure</h1>
    <div class="top">라이프</div>
    <img src="http://www.philgo.com/data/upload/4/1348724">
    <?php widget('post_latest', ['post_config_name'=>$widget_name, 'limit'=>40])?>
</div>