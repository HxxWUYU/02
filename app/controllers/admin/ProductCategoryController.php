<?php 
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\ValidateRequest;
use App\Models\Category;

class ProductCategoryController{

	public $table_name = 'categories';
	public $categories;
	public $links;

	public function __construct(){
		$total = Category::all()->count();
		$object = new Category;

		list($this->categories,$this->links) = paginate(3,$total,$this->table_name,$object);
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
						'minLength'=>3,
						'string'=>true,
						'unique'=>'categories'	
					]
				];

				$validate = new ValidateRequest;
				$validate->abide($_POST,$rules);

				if($validate->hasError()){
					$errors = $validate->getErrorMessages();
					return view('admin/products/categories',['categories'=>$this->categories,'links'=>$this->links,'errors'=>$errors]); 
					
				}
				//process form data
				Category::create([
					'name' => $request->name,
					'slug' => slug($request->name)
				]);
				
				$message = "Category Created";
				$total = Category::all()->count();
				list($this->categories,$this->links) = paginate(3,$total,$this->table_name,new Cat);
				return view('/admin/product/categories',['categories'=>$this->categories,'links'=>$this->links,'message'=>$message]); 
			}
			throw new \Exception ('Token mismatch');
		}
	}

	public function edit($id){
		if(Request::has('post')){
			$request = Request::get('post');//data in post
			
			if(CSRFToken::verifyCSRFToken($request->token,false)){

				$rules = [
					'name'=>[
						'required'=>true,
						'minLength'=>3,
						'string'=>true,
						'unique'=>'categories'	
					]
				];

				$validate = new ValidateRequest;
				$validate->abide($_POST,$rules);

				if($validate->hasError()){
					 $errors = $validate->getErrorMessages();
					 header("HTTP/1.1 422 Uprocessable Entity",true,422);
					 echo json_encode($errors);
					 exit;
					
					
				}

				Category::where('id',$id)->update(['name'=>$request->name]);
				echo json_encode(['success'=>'Record Updated']);
				exit;
				
			}
			throw new \Exception ('Token mismatch');
		}
	}

	public function delete($id){
		if(Request::has('post')){
			$request = Request::get('post');//data in post
			
			if(CSRFToken::verifyCSRFToken($request->token,true)){

				
				
				Category::destroy($id);
				Session::add('successs','Category Deleted');
				Redirect::to('admin/products/categories');
				
			}
			throw new \Exception ('Token mismatch');
		}
	}


}

?>