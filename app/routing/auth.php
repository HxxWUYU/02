<?php 
$router->map('GET','/02/public/register','App\Controllers\AuthController@showRegisterForm','register'); 
$router->map('POST','/02/public/register','App\Controllers\AuthController@register','register_me'); 
$router->map('GET','/02/public/login','App\Controllers\AuthController@showLoginForm','login'); 
$router->map('POST','/02/public/login','App\Controllers\AuthController@login','log_me_in'); 
?>