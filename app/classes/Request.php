<?php 
namespace App\Classes;

class Request{


	//return all request that we are interested in 
	public static function all($is_array = false){

		$result = [];
		if(count($_GET)>0){
			$result['get'] = $_GET;
		}

		if(count($_POST)>0){
			$result['post'] = $_POST;
		}

		$result['file'] = $_FILES;

		return json_decode(json_encode($result),$is_array);
	}
	//get specific request type

	public static function get($key,$is_array=false){
		$object = new static;
		$data = $object->all($is_array);

		return $data->$key;
	}
	//check requet availability

	public static function has ($key){
		return ((array_key_exists($key, self::all(true))) ? true:false);
	}
	//get request data
	//refresh request


}
?>