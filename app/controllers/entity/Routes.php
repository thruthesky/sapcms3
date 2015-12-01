<?php
$route['entity/list'] = 'entity/Entity_controller/collectionEntity';
$route['entity/(:any)/list'] = 'entity/Entity_controller/collection/$1';
$route['entity/(:any)/list/(:num)'] = 'entity/Entity_controller/collection/$1/$2';
$route['entity/(:any)/edit/(:num)'] = 'entity/Entity_controller/edit/$1/$2';



