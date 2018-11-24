<?php 

$router = new AltoRouter;
//echo $_SERVER['PHP_SELF']."<br>";

$router->map('GET','/02/public/','App\Controllers\IndexController@show','home'); //@sign can be custom 
$router->map('GET','/02/public/featured','App\Controllers\IndexController@featuredProducts','feature_product'); //@sign can be custom 
$router->map('GET','/02/public/get_products','App\Controllers\IndexController@getProducts','get_product'); //@sign can be custom 
$router->map('POST','/02/public/load_more','App\Controllers\IndexController@loadMoreProducts','load_more_product'); //@sign can be custom 

require_once __DIR__ . '/admin_route.php';



//for admin routes
//$match = $router->match()  match is an array containing 3 elements:
//traget, parmas, name // target is the App\..\ name is home



?>