<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class SubCategory extends Model{

	use SoftDeletes;
	public $timestamps = true;
	
	protected $fillable = ['name','slug','category_id'];//allow mass assignment
	protected $data = ['deleted_at'];

	public function transform($data){
		$subcategories=[];
		foreach ($data as $item) {
		//convert string to Carbon object then can call obj->toFormattedDateString()
		//$added = new Carbon($item->created_at); 

		array_push($categories,[
			'id'=>$item->id,
			'category_id'=>$item->category_id,
			'name' => $item->name,
			'slug' => $item->slug,
			'added' => $item->created_at
		]);
		}

		return $subcategories;
	}

}

?>