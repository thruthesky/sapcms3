<?php
$widget_name = $o;
?>
<style>
    .data img {
        width:100%;
    }
</style>
<div class="data">
    <div class="top">포럼</div>
    <img src="http://www.philgo.com/data/upload/0/1348750">
    <?php widget('post_latest', ['post_config_name'=>'freetalk', 'limit'=>40])?>
</div>