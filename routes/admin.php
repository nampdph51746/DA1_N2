<?php
use App\Controllers\Admin\UserController;
use App\Controllers\Admin\OrderController;
use App\Controllers\Admin\ReviewController;
use App\Controllers\Admin\ProductController;
use App\Controllers\Admin\VoucherController;
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ProductVariantController;
// $router->get('/admin', function () {
//     return "View Admin";
// });
$router->group(['before'=>'admin'], function($router){
    $router->group(['prefix' => 'admin'], function ($router) {
         //danh mục
        $router->get('/categories', [CategoryController::class,'index']);
        $router->get('/categories/create', [CategoryController::class,'create']);
        $router->post('/categories/store', [CategoryController::class,'store']);
        $router->get('/categories/edit/{id}', [CategoryController::class,'edit']);
        $router->post('/categories/update{id}', [CategoryController::class,'update']);
        $router->get('/categories/delete/{id}', [CategoryController::class,'destroy']);
        $router->get('categories/search', [CategoryController::class,'search']);

        // sản phẩm
        $router->get('/products',[ProductController::class,'index']);
        $router->get('products/create',[ProductController::class,'create']);
        $router->post('products/store',[ProductController::class,'store']);
        $router->get('products/edit/{id}',[ProductController::class,'edit']);
        $router->post('products/update/{id}',[ProductController::class,'update']);
        $router->get('products/delete/{id}',[ProductController::class,'destroy']);
        $router->get('products/detail/{id}',[ProductController::class,'detail']);
        $router->get('products/search', [ProductController::class,'search']);

        // Biến thể
        $router->get('product_variant/create/{id}', [ProductVariantController::class, 'create']);
        $router->post('product_variant/store',[ProductVariantController::class,'store']);
        $router->get('product_variant/edit/{id}',[ProductVariantController::class,'edit']);
        $router->post('product_variant/update/{id}',[ProductVariantController::class,'update']);
        $router->get('product_variant/delete/{id}',[ProductVariantController::class,'destroy']);

        // Người dùng
        $router->get('/users',[UserController::class,'index']);
        $router->get('users/create',[UserController::class,'create']);
        $router->post('users/store',[UserController::class,'store']);
        $router->get('users/edit/{id}',[UserController::class,'edit']);
        $router->post('users/update/{id}',[UserController::class,'update']);
        $router->get('users/delete/{id}',[UserController::class,'destroy']);
        $router->get('users/detail/{id}',[UserController::class,'detail']);
        $router->get('users/search', [UserController::class,'search']);

        // Đơn hàng
        $router->get('/orders',[OrderController::class,'index']);
        $router->get('orders/detail/{id}',[OrderController::class,'detail']);
        $router->post('orders/update-status',[OrderController::class,'updateStatus']);
        $router->get('orders/search', [OrderController::class,'search']);

        // Bình luận
        $router->get('/reviews',[ReviewController::class,'index']);
        $router->get('reviews/edit/{id}',[ReviewController::class,'edit']);
        $router->post('reviews/update/{id}',[ReviewController::class,'update']);
        $router->get('reviews/delete/{id}',[ReviewController::class,'destroy']);
        $router->get('reviews/detail/{id}',[ReviewController::class,'detail']);
        $router->get('reviews/search', [ReviewController::class,'search']);

        // Voucher
        $router->get('/vouchers',[VoucherController::class,'index']);
        $router->get('vouchers/edit/{id}',[VoucherController::class,'edit']);
        $router->post('vouchers/update/{id}',[VoucherController::class,'update']);
        $router->get('vouchers/delete/{id}',[VoucherController::class,'destroy']);
        $router->get('vouchers/detail/{id}',[VoucherController::class,'detail']);
        $router->get('vouchers/search', [VoucherController::class,'search']);
    });
});
