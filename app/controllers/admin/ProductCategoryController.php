<?php 
namespace App\Controllers\Admin;

use App\Models\Category;
use App\Classes\Request;
use App\Classes\CSRFToken;
use App\Classes\ValidateRequest;
class ProductCategoryController{

	public function show(){

		$categories = Category::all();

		return view('admin/products/categories',compact('categories')); 
		//compact(var) create an array that contains whatever variables are passed into it 
	}

	public function store(){
		if(Request::has('post')){
			$request = Request::get('post');//data in post
			$data = ValidateRequest::string('name',$request->name,true);
			if($data){
				echo "All good";exit;
			}else{
				echo "Not Email";exit;
			}
			if(CSRFToken::verifyCSRFToken($request->token)){
				//process form data
				Category::create([
					'name' => $request->name,
					'slug' => slug($request->name)
				]);
				$categories = Category::all();
				$message = "Category Created";
				return view('admin/products/categories',compact('categories','message')); 
			}
			throw new \Exception ('Token mismatch');
		}
	}
}

?>