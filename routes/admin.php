<?php
use App\Controllers\Admin\CategoryController;
use App\Controllers\Admin\ProductController;
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
    });
});
