<?php 
namespace App\Models;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model{

	use SoftDeletes;
	public $timestamps = true;
	
	protected $fillable = ['name','slug'];//allow mass assignment
	protected $data = ['deleted_at'];

	public function products(){
		return $this->hasMany(Product::class,'category_id','id');
		//In this case no need to specifi the foregin key 'category_id' and primary key 'id' because the naming is consistent, ORM will automatically find column 
		//with category_ in Product and match it with the Category tables' primary key
	}

	public function subCategories(){
		return $this->hasMany(SubCategory::class,'category_id','id');
		//
	}

	public function transform($data){
		$categories=[];
		foreach ($data as $item) {
		//convert string to Carbon object then can call obj->toFormattedDateString()
		//$added = new Carbon($item->created_at); 

		array_push($categories,[
			'id'=>$item->id,
			'name' => $item->name,
			'slug' => $item->slug,
			'added' => $item->created_at
		]);
		}

		return $categories;
	}

}

?>