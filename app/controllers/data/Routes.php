<?php
$route['data/upload'] = 'data/data_controller/upload';
$route['data/ajax/upload'] = 'data/data_controller/ajaxUpload';
$route['data/ajax/delete/(:num)'] = 'data/data_controller/ajaxDelete/$1';
$route['data/download'] = 'data/data_controller/download';
$route['data/download/base64/(:num)'] = 'data/data_controller/downloadBase64/$1';
$route['data/display/base64image/(:num)'] = 'data/data_controller/displayBase64Image/$1';


$route['data/test/upload'] = 'data/test_upload_controller/test_upload_form';