<?php


use App\Classes\Session;
use App\Models\User;
use Illuminate\Database\Capsule\Manager as Capsule;
use Philo\Blade\Blade;
use voku\helper\Paginator;



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

function slug($value){
	//remove all characters not in this list: underscore | letters | numbers | whitespace
	//pL letters ; pN numbers; s whitespace ; !u this should be treated as utf-8
	$value = preg_replace('![^'.preg_quote('_').'\pL\pN\s]+!u', '', mb_strtolower($value));

	//replace underscore and whitespace with a dash
	$value = preg_replace('!['.preg_quote('-').'\s]+!u', '-', $value);

	//remove whitespace
	return trim($value,'-');

}

function paginate($num_of_records,$total_record,$table_name,$object){

	

	$pages = new Paginator($num_of_records,'p');

	$pages->set_total($total_record);


	$data = Capsule::select("SELECT * FROM $table_name WHERE deleted_at is NULL ORDER BY created_at DESC".$pages->get_limit());

	$categories = $object->transform($data);



	return [$categories,$pages->page_links()];

}

function isAuthenticated(){
	return Session::has('SESSION_USER_NAME') ? true:false;
}

function user(){
	if(isAuthenticated()){
		return User::findOrFail(Session::get('SESSION_USER_ID'));
	}

	return false;
}

?>