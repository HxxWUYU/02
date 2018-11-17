<?php 

$router = new AltoRouter;
//echo $_SERVER['PHP_SELF']."<br>";

$router->map('GET','/02/public/','App\Controllers\IndexController@show','home'); //@sign can be custom 
$router->map('GET','/02/public/admin','App\Controllers\Admin\DashboardController@show','admin_dashboard'); //@sign can be custom 

$router->map('POST','/02/public/admin','App\Controllers\Admin\DashboardController@get','admin_form'); //@sign can be custom 

//product management
$router->map('GET','/02/public/admin/product/categories','App\Controllers\Admin\ProductCategoryController@show','product_category'); 

$router->map('POST','/02/public/admin/product/categories','App\Controllers\Admin\ProductCategoryController@store','create_product_category'); 



//for admin routes
//$match = $router->match()  match is an array containing 3 elements:
//traget, parmas, name // target is the App\..\ name is home



?>