<?php 

$router = new AltoRouter;
echo $_SERVER['PHP_SELF']."<br>";
$router->map('GET','\about','','about_us');

$match = $router->match();

if($match){
	echo "About us page";
}else{
	header($_SERVER["SERVER_PROTOCOL"].'404 Not Found');
	echo "This is Page not found";
}

?>