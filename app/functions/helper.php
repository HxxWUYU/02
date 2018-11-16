<?php

use Philo\Blade\Blade;

function view($path, array $data = [])
{	
	
    $view = __DIR__ . '/../../resources/views';
    $cache = __DIR__ . '/../../bootstrap/cache';
    // $view = "/var/www/html/02/resources/views/";
    // $cache = "/var/www/html/02/bootstrap/cache/";

    $blade = new Blade($view, $cache);    
   echo $blade->view()->make($path, $data)->render();

    //$blade->view();
}

function make($filename,$data){

	
	extract($data); //create variables using keys in $data as name and...
	ob_start();//打开缓冲区 所有来自php的非文件头信息均不会发送
	//而是保存在内部缓冲区 可以用 ob_end_flush() 或者flush()
	//输出缓冲区的内容
	//ob_get_contents() 返回缓冲区内容

	//include template
	include(__DIR__ . '/../../resources/views/emails/'.$filename.'.php');

	//get content of the file
	$content = ob_get_contents();

	//erase the output and turn off output buffering
	ob_end_clean();

	return $content;
}

?>