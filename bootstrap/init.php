<?php 

if(!isset($_SESSION)) session_start();

//load environment 
require_once __DIR__ .'/../app/config/env.php';

require_once __DIR__ .'/../app/routing/route.php';

new \App\RouteDispatcher($router);

?>