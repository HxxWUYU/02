<?php 
namespace App\Models;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model{

	use SoftDeletes;
	public $timestamps = true;
	
	protected $fillable = ['user_id','order_no','product_id','unit_price','quantity','status','total'];//allow mass assignment
	protected $data = ['deleted_at'];


}

?>