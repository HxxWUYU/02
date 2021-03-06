<?php 

// use App\Classes\Database;
// use App\RouteDispatcher;

if(!isset($_SESSION)) session_start();

//load environment 
require_once __DIR__ .'/../app/config/env.php';

//instantiate database class
new \App\Classes\Database();

//set custom error handler

set_error_handler([new \App\Classes\ErrorHandler(),'handleErrors']);

require_once __DIR__ .'/../app/routing/route.php';

new \App\RouteDispatcher($router);

?>