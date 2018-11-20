<?php 
namespace App\Models;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
		$category = Category::where('id',$item->category_id)->
				get();

		array_push($subcategories,[
			'id'=>$item->id,
			'category_id'=>$item->category_id,
			'category_name'=>$category->name,
			'name' => $item->name,
			'slug' => $item->slug,
			'added' => $item->created_at
		]);
		}

		return $subcategories;
	}

}

?>