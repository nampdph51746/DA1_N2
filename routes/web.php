<?php

use App\Controllers\HomeController;
use App\Models\Post;

// $router->get('/', function () {
//     return "Phần dàn cho khách";
// });
$router->get('/',[HomeController::class,'index']);
