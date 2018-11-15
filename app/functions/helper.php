<?php

use Philo\Blade\Blade;

function view($path, array $data = [])
{	
	
    //$view = __DIR__ . '/../../resources/views';
    //$cache = __DIR__ . '/../../bootstrap/cache';
    $view = "/var/www/html/02/resources/views/";
    $cache = "/var/www/html/02/bootstrap/cache/";

    $blade = new Blade($view, $cache);    
   echo $blade->view()->make($path, $data)->render();

    //$blade->view();
}

?>