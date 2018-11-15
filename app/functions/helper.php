<?php

use Philo\Blade\Blade;

function view($path, array $data = [])
{	
	echo "hh";
    $view = __DIR__ . '/../../resources/views';
    $cache = __DIR__ . '/../../bootstrap/cache';
    echo $view;
    // $blade = new Blade($view, $cache);
    
   //echo $blade->view()->make($path, $data)->render();
    //$blade->view();
}

?>