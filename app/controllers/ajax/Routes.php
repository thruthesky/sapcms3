<?php
$route['ajax/info'] = 'ajax/ajax_controller/info';
$route['ajax/cache/page/(:any)'] = 'ajax/ajax_controller/page/$1';
$route['ajax/cache/widget/(:any)'] = 'ajax/ajax_controller/widget/$1';
$route['ajax/endless'] = 'ajax/ajax_controller/endless';
$route['ajax/version'] = 'ajax/ajax_controller/version';
