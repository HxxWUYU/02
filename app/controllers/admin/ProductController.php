<?php 
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\SubCategory;

class ProductController extends BaseController{

	public $table_name = 'categories';
	public $categories;
	public $subcategories;
	public $subcategories_links;
	public $links;

	public function __construct(){
	
		
		$this->categories = Category::all();

		// list($this->categories,$this->links) = paginate(3,$total,$this->table_name,$object);

		// list($this->subcategories,$this->subcategories_links) = paginate(3,$subTotal,"sub_categories",new SubCategory);
	}

	public function showCreateProductForm(){


		$categories = $this->categories;
		return view('admin/products/create',compact('categories'));

		
	}

	public function getSubcategories($id){
		$subcategories = SubCategory::where('category_id',$id)->get();
		echo json_encode($subcategories);
		exit;
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
					return view('admin/products/categories',['categories'=>$this->categories,'links'=>$this->links,'errors'=>$errors,'subcategories'=>$this->subcategories,'subcategories_links'=>$this->subcategories_links]); 
					
				}
				//process form data
				Category::create([
					'name' => $request->name,
					'slug' => slug($request->name)
				]);
				
				$message = "Category Created";

				$total = Category::all()->count();
				$subTotal = SubCategory::all()->count();
				list($this->categories,$this->links) = paginate(3,$total,$this->table_name,new Category);
				list($this->subcategories,$this->subcategories_links) = paginate(3,$subTotal,"sub_categories",new SubCategory);
				return view('admin/products/categories',['categories'=>$this->categories,'links'=>$this->links,'message'=>$message,'subcategories'=>$this->subcategories,'subcategories_links'=>$this->subcategories_links]); 
				exit;
				
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

				Category::where('id',$id)->update(['name'=>$request->name,'slug'=>slug($request->name)]);
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

				$subcategories = SubCategory::where('category_id',$id)->
				get();

				if(count($subcategories)>0){
					foreach ($subcategories as $subcategory) {
						$subcategory->delete();
					}
				}
				Session::add('success','Category Deleted');
				Redirect::to('/02/public/admin/product/categories');
				
			}
			throw new \Exception ('Token mismatch');
		}
	}


}

?>