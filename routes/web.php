<?php

use App\Models\Post;
use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\ReviewController;

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

$router->get('/login',[AuthController::class,'login']);
$router->post('/login',[AuthController::class,'postLogin']);
$router->get('/register',[AuthController::class,'register']);
$router->post('/register',[AuthController::class,'store']);
$router->get('/logout',[AuthController::class,'logout']);
$router->get('/profile' ,[AuthController::class , 'profile']);
$router->post('/reviews/store',[ReviewController::class,'store']);
// kiểm tra xem email và sđt
$router->get('forgot-password',[AuthController::class,'ForgotPasswordForm']);
$router->post('forgot-password',[AuthController::class,'handleForgotPassword']);
// đặt mật khẩu lại
$router->get('reset-password',[AuthController::class,'showResetPasswordForm']);
$router->post('reset-password',[AuthController::class,'handleResetPassword']);