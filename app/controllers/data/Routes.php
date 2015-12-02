<?php
$route['data/upload'] = 'data/data_controller/upload';
$route['data/ajax/upload'] = 'data/data_controller/ajaxUpload';
$route['data/ajax/delete/(:num)'] = 'data/data_controller/ajaxDelete/$1';
$route['data/download'] = 'data/data_controller/download';



$route['data/test/upload'] = 'data/test_upload_controller/test_upload_form';