<?php
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ProductController;
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
       
        // sản phẩm
        $router->get('products',[ProductController::class,'index']);
        $router->get('products/create',[ProductController::class,'create']);
        $router->post('products/store',[ProductController::class,'store']);
        $router->get('products/edit/{id}',[ProductController::class,'edit']);
        $router->post('products/update/{id}',[ProductController::class,'update']);
        $router->get('products/delete/{id}',[ProductController::class,'destroy']);
        $router->get('products/detail/{id}',[ProductController::class,'detail']);
        
        // Biến thể
        $router->get('product_variant/create/{id}', [ProductVariantController::class, 'create']);
        $router->post('product_variant/store',[ProductVariantController::class,'store']);
        $router->get('product_variant/edit/{id}',[ProductVariantController::class,'edit']);
        $router->post('product_variant/update/{id}',[ProductVariantController::class,'update']);
        $router->get('product_variant/delete/{id}',[ProductVariantController::class,'destroy']);
    });
});
