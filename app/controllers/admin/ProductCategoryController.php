<?php 
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Request;
use App\Classes\ValidateRequest;
use App\Models\Category;

class ProductCategoryController{

	public $table_name = 'categories';
	public $categories;
	public $links;

	public function __construct(){
		$total = Category::all()->count();
		$object = new Category;

		list($this->categories,$this->links) = paginate(2,$total,$this->table_name,$object);
	}

	public function show(){

		

		return view('admin/products/categories',['categories'=>$this->categories,'links'=>$this->links]); 
		//compact(var) create an array that contains whatever variables are passed into it 
	}

	public function store(){
		if(Request::has('post')){
			$request = Request::get('post');//data in post
			
			if(CSRFToken::verifyCSRFToken($request->token)){

				$rules = [
					'name'=>[
						'required'=>true,
						'maxLength'=>5,
						'string'=>true,
						'unique'=>'categories'	
					]
				];

				$validate = new ValidateRequest;
				$validate->abide($_POST,$rules);

				if($validate->hasError()){
					$errors = $validate->getErrorMessages();
					return view('admin/products/categories',['categories'=>$this->categories,'links'=>$this->links,'errors'=>$this->errors]); 
					
				}
				//process form data
				Category::create([
					'name' => $request->name,
					'slug' => slug($request->name)
				]);
				$categories = Category::all();
				$message = "Category Created";
				return view('admin/products/categories',['categories'=>$this->categories,'links'=>$this->links,'message'=>$this->message]); 
			}
			throw new \Exception ('Token mismatch');
		}
	}
}

?>