<?php 
$router->map('POST','/02/public/cart','App\Controllers\CartController@addItem','add_cart_item');
$router->map('GET','/02/public/cart','App\Controllers\CartController@show','view_cart');
$router->map('GET','/02/public/cart/items','App\Controllers\CartController@getCartItems','get_cart_items');
$router->map('POST','/02/public/cart/update_qty','App\Controllers\CartController@updateQty','update_cart_qty');
$router->map('POST','/02/public/cart/remove','App\Controllers\CartController@removeItem','remove_item');
$router->map('POST','/02/public/cart/checkout','App\Controllers\CartController@checkout','handle_payment');
$router->map('GET','/02/public/cart/clear','App\Controllers\CartController@clearCart','clear_cart');
?>