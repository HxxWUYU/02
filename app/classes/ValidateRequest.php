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
}
?>