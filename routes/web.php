<?php
$route->get('/',[(new controllers\HomeController($database,$config,$cache)),'index']);

$route->get('products',[(new controllers\ProductController($database,$config,$cache)),'index']);
$route->get('products/create',[(new controllers\ProductController($database,$config,$cache)),'create']);
$route->post('products/store',[(new controllers\ProductController($database,$config,$cache)),'store']);
$route->get('products/edit',[(new controllers\ProductController($database,$config,$cache)),'edit']);
$route->post('products/update',[(new controllers\ProductController($database,$config,$cache)),'update']);
$route->post('products/delete',[(new controllers\ProductController($database,$config,$cache)),'destroy']);

$route->get('orders',[(new controllers\OrderController($database,$config,$cache)),'index']);
$route->post('orders/store',[(new controllers\OrderController($database,$config,$cache)),'store']);
$route->post('orders/delete',[(new controllers\OrderController($database,$config,$cache)),'destroy']);
$route->post('checkout',[(new controllers\OrderController($database,$config,$cache)),'checkout']);