<?php
$route['post/config/list'] = 'post/PostConfig_controller/collection';
$route['post/config/create'] = 'post/PostConfig_controller/createSubmit';



$route['(:any)/list'] = 'post/PostData_controller/collection/$1';
$route['(:any)/list/(:num)'] = 'post/PostData_controller/collection/$1/$2';

$route['(:any)/view/(:num)'] = 'post/postdata_controller/view/$1/$2';


$route['(:any)/edit'] = 'post/postdata_controller/edit/$1';
$route['(:any)/edit/(:num)'] = 'post/postdata_controller/edit/$1/$2';

$route['post/edit/submit'] = 'post/postdata_controller/editSubmit';
