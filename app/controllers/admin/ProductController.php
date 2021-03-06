<?php 
namespace App\Controllers\Admin;

use App\Classes\CSRFToken;
use App\Classes\Redirect;
use App\Classes\Request;
use App\Classes\Role;
use App\Classes\Session;
use App\Classes\UploadFile;
use App\Classes\ValidateRequest;
use App\Controllers\BaseController;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;

class ProductController extends BaseController{

	public $table_name = 'products';
	public $products;
	public $categories;
	public $subcategories;
	public $subcategories_links;
	public $links;

	public function __construct(){
		if(!Role::middleware('admin')){
			Redirect::to('/02/public/login');
		}
		
		$this->categories = Category::all();

		 $total = Product::all()->count();
		 list($this->products,$this->links) = paginate(10,$total,$this->table_name,new Product);

		// list($this->subcategories,$this->subcategories_links) = paginate(3,$subTotal,"sub_categories",new SubCategory);
	}

	public function showEditProductForm($id){

		$categories = $this->categories;
		$product = Product::where('id',$id)->with(['category','subCategory'])->first();
		return view("admin/products/edit",compact('product','categories'));
	}

	public function show(){
		//$product = Product::where('id',3)->with(['category','subCategory'])->first();
		//var_dump($product);
		
		$products = $this->products;
		$links =$this->links;
		return view('admin/products/inventory',compact('products','links'));
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
				

				if($filename==''){
					$file_error['productImage']=['The product image is required'];
				}else if(!UploadFile::isImage($filename)){

					
					$file_error['productImage']=['The image is invalid,please try again'];
				}

				if($validate->hasError()||count($file_error)>0){
					$response = $validate->getErrorMessages();
					if(count($file_error)>0){
						$errors = array_merge($response,$file_error);
					}else{
						$errors = $response;
					}


					return view('admin/products/create',['categories'=>$this->categories,'errors'=>$errors]); 
					
				}

				$ds = DIRECTORY_SEPARATOR;
				$temp_file = $file->productImage->tmp_name;
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
			$file_error=[];
			
			if(CSRFToken::verifyCSRFToken($request->token)){

				$rules = [
					'name'=>[
						'required'=>true,
						'minLength'=>3,
						'maxLength'=>70,
						'string'=>true,
						'mixed'=>true
			
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
				

				if($validate->hasError()){
					$response = $validate->getErrorMessages();
					if(count($file_error)>0){
						$errors = array_merge($response,$file_error);
					}else{
						$errors = $response;
					}
					$categories = $this->categories;
					$product = Product::where('id',$request->product_id)->with(['category','subCategory'])->first();
					return view("admin/products/edit",compact('product','categories','errors'));
					// return view('admin/products/edit',['categories'=>$this->categories,'errors'=>$errors]); 

					
				}

				//$product = Product::where('id',$request->product_id)->first();
				$product=Product::findOrFail($request->product_id);
				//If not found, throw an excepetion

				$product->name = $request->name;
				$product->description = $request->description;
				$product->price = $request->price;
				$product->category_id = $request->category;
				$product->sub_category_id = $request->subcategory;
	

				// if(!$product){
				// 	throw new \Exception("Invalid product ID");
				// }
				if($filename){
					$ds = DIRECTORY_SEPARATOR;
					//old_image_path
				$old = BASE_PATH."{$ds}public{$ds}$product->image_path";
				$temp_file = $file->productImage->tmp_name;
				$image_path = UploadFile::move($temp_file,"images{$ds}uploads{$ds}products",$filename)->path();
				unlink($old);
				$product->image_path=$image_path;
				}

				$product->save();
				

				//process form data
				
				Session::add('success','Record Updated');
				Request::refresh();
				Redirect::to("/02/public/admin/product/inventory");
			}else{
				throw new \Exception ('Token mismatch');
			}
			
		}
	}

	public function delete($id){
		if(Request::has('post')){
			$request = Request::get('post');//data in post
			
			if(CSRFToken::verifyCSRFToken($request->token,true)){

				
				
				Product::destroy($id);

				Session::add('success','Product Deleted');
				Redirect::to('/02/public/admin/product/inventory');
				
			}
			
		}else{
			throw new \Exception ('Token mismatch');
		}
	}


}

?>