<?php 

$router = new AltoRouter;
//echo $_SERVER['PHP_SELF']."<br>";

$router->map('GET','/02/public/','App\Controllers\IndexController@show','home'); //@sign can be custom 

//for admin routes
//$router->map('GET','/02/public/admin','App\Controllers\Admin\DashboardController@show','admin_dashboard'); //@sign can be custom 
//$match = $router->match()  match is an array containing 3 elements:
//traget, parmas, name // target is the App\..\ name is home



?>