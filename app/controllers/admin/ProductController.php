<?php 
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Session;
use App\Classes\UploadFile;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends BaseController{

	public $table_name = 'products';
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
			$file_error=[];
			
			if(CSRFToken::verifyCSRFToken($request->token)){

				$rules = [
					'name'=>[
						'required'=>true,
						'minLength'=>3,
						'maxLength'=>70,
						'string'=>true,
						'mixed'=>true,
						'unique'=>$this->table_name
					],
					'price'=>['required'=>true,'minLength'=>2,'number'=>true],
					'quantity'=>['required'=>true],
					'category'=>['required'=>true],
					'subcategory'=>['required'=>true],
					'description'=>['required'=>true,'mixed'=>true,'minLength'=>4,'maxLength'=>500]
				];

				$validate = new ValidateRequest;
				$validate->abide($_POST,$rules);

				$file = Request::get('file');
				

				if(isset($file->productImage->name)){
					$filename = $file->productImage->name;
				}else{
					$filename='';
				}
				

				if(empty($filename)){
					$file_error['productImage']=['The product image is required'];
				}else if(!UploadFile::isImage($file)){
					$file_error['productImage']=['The image is invalid,please try again'];
				}

				if($validate->hasError()){
					$response = $validate->getErrorMessages();
					if(count($file_error)>0){
						$errors = array_merge($response,$file_error);
					}else{
						$errors = $response;
					}
					return view('admin/products/create',['categories'=>$this->categories,'errors'=>$errors]); 
					
				}

				$ds = DIRECTORY_SEPARATOR;
				$temp_file = $file->productImage->temp_name;
				$image_path = UploadFile::move($temp_file,"images{$ds}uploads{$ds}products",$filename)->path();

				//process form data
				Product::create([
					'name' => $request->name,
					'description' => $request->description,
					'price' => $request->price,
					'category_id' => $request->category,
					'sub_category_id' => $request->subcategory,
					'image_path' => $image_path,
					'quantity' => $request->quantity
				]);

				Request::refresh();
				
				$message = "Product Created";

				return view('admin/products/create',['categories'=>$this->categories,'message'=>$message]); 
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