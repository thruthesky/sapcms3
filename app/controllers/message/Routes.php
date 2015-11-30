<?php
$route['message/testdata'] = 'message/MessageTestData_controller/testData';
$route['message/testdata/remove'] = 'message/MessageTestData_controller/testData_remove';

//'collection' should be list but was change due to post routing conflict
$route['message/inbox'] = 'message/Message_controller/inbox';
$route['message/inbox/(:num)'] = 'message/Message_controller/inbox/$1';

$route['message/unread'] = 'message/Message_controller/unread';
$route['message/unread/(:num)'] = 'message/Message_controller/unread/$1';

$route['message/sent'] = 'message/Message_controller/sent';
$route['message/sent/(:num)'] = 'message/Message_controller/sent/$1';

$route['message/send'] = 'message/Message_controller/send';
$route['message/send/(:num)'] = 'message/Message_controller/send/$1';
$route['message/send/submit'] = 'message/Message_controller/sendSubmit';

$route['message/viewItem/(:num)'] = 'message/Message_controller/viewItem/$1';
//type,offset,id
$route['message/deleteItem/(inbox|unread|sent)/(:num)/(:num)'] = 'message/Message_controller/deleteItem/$1/$2/$3';

$route['message/ajax/load'] = 'message/Message_controller/ajaxLoad';
$route['message/ajax/delete'] = 'message/Message_controller/ajaxDelete';