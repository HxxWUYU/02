<?php
namespace App\Classes;
use Illuminate\Database\Capsule\Manager as Capsule;

class ValidateRequest{

	public function unique($column,$value,$policy){

		if($value!=null && !empty(trim($value))){
			return !(Capsule::table($policy)->where($column,'=',$value)->exists());
		}
		return true;
	}
}
?>