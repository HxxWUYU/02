<?php 

$router = new AltoRouter;
//echo $_SERVER['PHP_SELF']."<br>";

$router->map('GET','/02/public/','App\Controllers\IndexController@show','home'); //@sign can be custom 
$router->map('GET','/02/public/featured','App\Controllers\IndexController@featuredProducts','feature_product'); //@sign can be custom 
$router->map('GET','/02/public/get_products','App\Controllers\IndexController@getProducts','get_product'); //@sign can be custom 
$router->map('POST','/02/public/load_more','App\Controllers\IndexController@loadMoreProducts','load_more_product'); //@sign can be custom 
$router->map('GET','/02/public/product/[i:id]','App\Controllers\ProductController@show','product'); //@sign can be custom 

$router->map('GET','/02/public/product_details/[i:id]','App\Controllers\ProductController@get','product_details'); //@sign can be custom 


$router->map('POST','/02/public/cart','App\Controllers\CartController@addItem','add_cart_item');
$router->map('GET','/02/public/cart','App\Controllers\CartController@show','view_cart');
$router->map('GET','/02/public/cart/items','App\Controllers\CartController@getCartItems','get_cart_items');
$router->map('POST','/02/public/cart/update_qty','App\Controllers\CartController@updateQty','update_cart_qty');

require_once __DIR__ . '/admin_route.php';



//for admin routes
//$match = $router->match()  match is an array containing 3 elements:
//traget, parmas, name // target is the App\..\ name is home



?>