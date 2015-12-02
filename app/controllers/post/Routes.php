<?php

$route['post/testdata'] = 'post/PostTestData_controller/testdata';
$route['post/testdata/remove'] = 'post/PostTestData_controller/testdata_remove';



$route['post/config/list'] = 'post/PostConfig_controller/collection';
$route['post/config/create'] = 'post/PostConfig_controller/createSubmit';

$route['(:any)/list'] = 'post/PostData_controller/collection/$1';
$route['(:any)/list/(:num)'] = 'post/PostData_controller/collection/$1/$2';

$route['(:any)/view/(:num)'] = 'post/postdata_controller/view/$1/$2';

$route['(:any)/edit'] = 'post/postdata_controller/edit/$1';
$route['(:any)/edit/(:num)'] = 'post/postdata_controller/edit/$1/$2';

$route['(:any)/edit/submit'] = 'post/postdata_controller/editSubmit/$1';


$route['post/comment/submit'] = 'post/postdata_controller/commentSubmit';
$route['post/comment/edit/submit'] = 'post/postdata_controller/commentEditSubmit';


$route['(:any)/edit/ajax/submit'] = 'post/postdata_controller/ajaxEditSubmit';

$route['post/ajax/comment/edit/(:num)'] = 'post/postdata_controller/ajaxCommentEdit/$1';

$route['post/ajax/delete/(:num)'] = 'post/postdata_controller/ajaxDelete/$1';