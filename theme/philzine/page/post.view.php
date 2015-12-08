<?php
if ( ! isset($this->data['post']) ) return;



widget( $this->data['config']->get('widget_view') );