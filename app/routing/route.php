<?php 

$router = new AltoRouter;
//echo $_SERVER['PHP_SELF']."<br>";

$router->map('GET','/02/public/','','home');

$match = $router->match();

if($match){
	require_once __DIR__ . '/../controllers/BaseController.php';
	require_once __DIR__ . '/../controllers/IndexController.php';
	$index = new \App\Controllers\IndexController();
	$index->show();
}else{
	header($_SERVER["SERVER_PROTOCOL"].'404 Not Found');
	echo "This is Page not found";
}

?>