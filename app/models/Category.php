<?php 
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model{

	use SoftDeletes;
	protected $timestamps = true;
	protected $fillable = ['name','slug'];//allow mass assignment
	protected $data = ['deleted_at'];

}

?>