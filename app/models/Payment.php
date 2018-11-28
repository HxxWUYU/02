<?php 
namespace App\Models;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model{

	use SoftDeletes;
	public $timestamps = true;
	
	protected $fillable = ['user_id','order_no','amount','status'];//allow mass assignment
	protected $data = ['deleted_at'];


}

?>