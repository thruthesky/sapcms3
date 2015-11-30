<?php
$route['test'] = 'test/test_controller';
$route['test/testdata'] = 'test/testData_controller';
$route['test/(:any)'] = 'test/test_controller/testPart/$1';


