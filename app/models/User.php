<?php 
namespace App\Models;
use App\Models\Product;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model{

	use SoftDeletes;
	public $timestamps = true;
	
	protected $fillable = ['username','fullname','email','password','address','role'];//allow mass assignment
	protected $data = ['deleted_at'];


}

?>