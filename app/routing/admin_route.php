<?php 


$router->map('GET','/02/public/admin','App\Controllers\Admin\DashboardController@show','admin_dashboard'); //@sign can be custom 

$router->map('POST','/02/public/admin','App\Controllers\Admin\DashboardController@get','admin_form'); //@sign can be custom 

//product management
$router->map('GET','/02/public/admin/product/categories','App\Controllers\Admin\ProductCategoryController@show','product_category'); 

$router->map('POST','/02/public/admin/product/categories','App\Controllers\Admin\ProductCategoryController@store','create_product_category'); 

$router->map('POST','/02/public/admin/product/categories/[i:id]/edit','App\Controllers\Admin\ProductCategoryController@edit','edit_product_category'); 


$router->map('POST','/02/public/admin/product/categories/[i:id]/delete','App\Controllers\Admin\ProductCategoryController@delete','delete_product_category');


$router->map('POST','/02/public/admin/product/subcategory/create','App\Controllers\Admin\SubCategoryController@store','create_subcategory');

$router->map('POST','/02/public/admin/product/subcategory/[i:id]/edit','App\Controllers\Admin\SubCategoryController@edit','edit_subcategory');

$router->map('POST','/02/public/admin/product/subcategory/[i:id]/delete','App\Controllers\Admin\SubCategoryController@delete','delete_subcategory');

$router->map('GET','/02/public/admin/product/create','App\Controllers\Admin\ProductController@showCreateProductForm','create_product_form');

$router->map('POST','/02/public/admin/category/[i:id]/selected','App\Controllers\Admin\ProductController@getSubcategories','selected_category');

$router->map('POST','/02/public/admin/product/create','App\Controllers\Admin\ProductController@store','create_product');


$router->map('GET','/02/public/admin/product/inventory','App\Controllers\Admin\ProductController@show','show_product');

$router->map('GET','/02/public/admin/product/[i:id]/edit','App\Controllers\Admin\ProductController@showEditProductForm','edit_product_form');

$router->map('POST','/02/public/admin/product/edit','App\Controllers\Admin\ProductController@edit','edit_product');

$router->map('POST','/02/public/admin/product/[i:id]/delete','App\Controllers\Admin\ProductController@delete','delete_product');

//for admin routes
//$match = $router->match()  match is an array containing 3 elements:
//traget, parmas, name // target is the App\..\ name is home



?>