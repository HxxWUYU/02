<?php 


$router->map('GET','/02/public/admin','App\Controllers\Admin\DashboardController@show','admin_dashboard'); //@sign can be custom 

$router->map('POST','/02/public/admin','App\Controllers\Admin\DashboardController@get','admin_form'); //@sign can be custom 

//product management
$router->map('GET','/02/public/admin/product/categories','App\Controllers\Admin\ProductCategoryController@show','product_category'); 

$router->map('POST','/02/public/admin/product/categories','App\Controllers\Admin\ProductCategoryController@store','create_product_category'); 

$router->map('POST','/02/public/admin/product/categories/[i:id]/edit','App\Controllers\Admin\ProductCategoryController@edit','edit_product_category'); 


$router->map('POST','/02/public/admin/product/categories/[i:id]/delete','App\Controllers\Admin\ProductCategoryController@delete','delete_product_category');


$router->map('POST','/02/public/admin/subcategory/create','App\Controllers\Admin\SubCategoryController@store','create_subcategory');

//for admin routes
//$match = $router->match()  match is an array containing 3 elements:
//traget, parmas, name // target is the App\..\ name is home



?>