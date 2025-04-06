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
$router->get('/cart',[HomeController::class,'cart']);
$router->post('/add-to-cart',[HomeController::class,'addToCart']);
$router->post('/increase-quantity',[HomeController::class,'increaseQuantity']);
$router->post('/decrease-quantity',[HomeController::class,'decreaseQuantity']);
$router->post('/apply-voucher',[HomeController::class,'applyVoucher']);
$router->get('/remove-from-cart/{key}',[HomeController::class,'removeFromCart']);
