<?php
$widget_name = $o;
?>
<style>
    .data img {
        width:100%;
    }
</style>

<div class="data">
<div class="top">필리핀 매거진</div>
<img src="http://philgo.com/theme/philgo/img/banner/nolbu.gif">
<?php widget('post_latest', ['post_config_name'=>$widget_name, 'limit'=>40])?>
</div>