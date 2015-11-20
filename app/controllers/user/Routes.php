<?php
$route['user/register'] = 'user/user_controller/register';


$route['user/list'] = 'user/user_controller/collection';
$route['user/list/(:any)'] = 'user/user_controller/collection/$1';

$route['user/edit/(:num)'] = 'user/user_controller/edit/$1';
$route['user/editSubmit'] = 'user/user_controller/editSubmit';
$route['user/delete/(:num)'] = 'user/user_controller/delete/$1';
