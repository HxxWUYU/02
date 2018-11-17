<?php 
namespace App\Controllers\Admin;

use App\Models\Category;

class ProductCategoryController{

	public function show(){

		$categories = Category::all();

		return view('admin/products/categories',compact('categories')); //compact(var) create an array that contains whatever variables are passed into it 
	}

	public function store(){

	}
}

?>