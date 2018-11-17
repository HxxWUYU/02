<?php
namespace App\Classes;
use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest{

	protected static function unique($column,$value,$policy){

		if($value!=null && !empty(trim($value))){
			return !(Capsule::table($policy)->where($column,'=',$value)->exists());
		}
		return true;
	}

	public static function required($column,$value,$policy){
		return ($value!==null && !empty(trim($value)));
	}

	public static function minLength($column,$value,$policy){
		if($value!=null && !empty(trim($value))){
			return strlen($value)>=$policy;
		}
		return true;
	}

	public static function maxLength($column,$value,$policy){
		if($value!=null && !empty(trim($value))){
			return strlen($value)<=$policy;
		}
		return true;
	}

	public static function email($column,$value,$policy){

		if($value!=null && !empty(trim($value))){
			return filter_var($value,FILTER_VALIDATE_EMAIL);
		}
		return true;
	}		

	public static function mixed($column,$value,$policy){
		if($value!=null && !empty(trim($value))){
			if(!preg_match('/^[A-Za-z0-9 .,_~\-!@#\&%\^\'\*\(\)]+$/', $value)){
				return false;
			}
		}
		return true;
	}

	public static function string($column,$value,$policy){
		if($value!=null && !empty(trim($value))){
			if(!preg_match('/^[A-Za-z ]+$/', $value)){
				return false;
			}
		}
		return true;
	}


	
}
?>