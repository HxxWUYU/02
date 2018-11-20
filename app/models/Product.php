<?php 
namespace App\Models;
use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model{

	use SoftDeletes;
	public $timestamps = true;
	
	protected $fillable = ['name','price','description','category_id','sub_category_id','image_path','quantity'];//allow mass assignment
	protected $data = ['deleted_at'];

	public function category(){
		return $this->belongsTo(Category::class);
	}

	public function subCategory(){
		return $this->belongsTo(SubCategory::class);
	}

	public function transform($data){
		$products=[];
		foreach ($data as $item) {
		//convert string to Carbon object then can call obj->toFormattedDateString()
		//$added = new Carbon($item->created_at); 

		array_push($products,[
			'id'=>$item->id,
			'name' => $item->name,
			'description' => $item->description,
			'price' => $item->price,
			'image_path' => $item->image_path,
			'quantity' => $item->quantity,
			'category_id' => $item->category_id,
			'category_name' => Category::where('id',$item->category_id)->first()->name,
			'sub_category_id' => $item->sub_category_id,
			'sub_category_name' => SubCategory::where('id',$item->sub_category_id)->first()->name,
			'added' => $item->created_at
		]);
		}

		return $products;
	}

}

?>