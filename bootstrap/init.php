<?php 

if(!isset($_SESSION)) session_start();

//load environment 
require_once __DIR__ .'/../app/config/env.php';

//instantiate database class
new \App\Classes\Database();

require_once __DIR__ .'/../app/routing/route.php';

new RouteDispatcher($router);

?>