<?php
$route['user/register'] = 'user/user_controller/register';


$route['user/login'] = 'user/user_controller/login';
$route['user/login/submit'] = 'user/user_controller/loginsubmit';


$route['user/admin/list'] = 'user/user_controller/collection';
$route['user/admin/list/(:any)'] = 'user/user_controller/collection/$1';

$route['user/admin/edit/(:num)'] = 'user/user_controller/edit/$1';
$route['user/editSubmit'] = 'user/user_controller/editSubmit';
$route['user/admin/delete/(:num)'] = 'user/user_controller/delete/$1';

