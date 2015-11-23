<?php
//'collection' should be list but was change due to post routing conflict
$route['message/collection'] = 'message/Message_controller/collection';
$route['message/collection/(:num)'] = 'message/Message_controller/collection/$1';
$route['message/write'] = 'message/Message_controller/write';
$route['message/write/(:num)'] = 'message/Message_controller/write/$1';
$route['message/write/submit'] = 'message/Message_controller/writeSubmit';
