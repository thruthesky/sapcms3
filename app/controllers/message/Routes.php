<?php
//'collection' should be list but was change due to post routing conflict
$route['message/inbox'] = 'message/Message_controller/collection';
$route['message/inbox/(:num)'] = 'message/Message_controller/collection/$1';

$route['message/outbox'] = 'message/Message_controller/collection';
$route['message/outbox/(:num)'] = 'message/Message_controller/collection/$1';

$route['message/send'] = 'message/Message_controller/send';
$route['message/send/(:num)'] = 'message/Message_controller/send/$1';
$route['message/send/submit'] = 'message/Message_controller/writeSubmit';
