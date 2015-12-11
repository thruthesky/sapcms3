<?php
	widget_css();
	$posts = [];
	if( is_array($o) ) $posts = $o;
	else $posts[] = $o;
?>
<ul class="list-group bullet-list">
	<?php foreach( $posts as $p ){ 
		$content = mb_strcut ( $p['content'], 0, 40 );//temp
	?>
		<li class="list-group-item">
			<span class='bullet'></span>
			<a href='#'><?php echo $content; ?></a>
		</li>
<?php 
	} 
?>
</ul>