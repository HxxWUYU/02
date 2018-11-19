<?php 
namespace App\Classes;

class Session{

	//create a session

	public static function add($name,$value){

		if($name!='' && (!empty($name)) && $value!='' && (!empty($value))){
			return $_SESSION[$name] = $value;
		}
		

		throw new \Exception ('Name and value required');
		//在一个命名空间中 调用其他类必须声明命名空间 否则会在当前
		//命名空间内寻找 throw new Exception 会报错
	}

	//get value from session
	public static function get($name){
		return $_SESSION[$name];
	}
	//check if session exists

	public static function has($name){
		

		if($name!='' && (!empty($name))){
			return ((isset($_SESSION[$name])) ? true : false);
		}

		throw new \Exception('name is required');
	}
	//remove session

	public static function remove($name){

		if(self::has($name)){
			//$this调用的是实例化的对象
			//静态方法/变量必须用self 调用
			unset($_SESSION[$name]);
		}

	}

	public static function flash($name,$value='null'){
		if(self::has($name)){
			$old_value  = self::get($name);
			self::remove($name);
			return $old_value;
		}else{
			self::add($name,$value);
		}

		return null;
	}
}

?>