<?php

use App\Controllers\HomeController;
use App\Models\Post;

// $router->get('/', function () {
//     return "Phần dàn cho khách";
// });
$router->get('/',[HomeController::class,'index']);
$router->get('/sanpham',[HomeController::class,'sanpham']);
$router->get('/timkiem',[HomeController::class,'timkiem']);
$router->get('sanpham/chitiet/{id}',[HomeController::class,'chitiet']);
