<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
   public function addCategory(Request $request){
	   if($request->isMethod('post')){
		   
		   $data= $request->all();
		   
		   //echo"<pre>";print_r($data);die;
		   $category= new Category;
		   $category->parent_id = $data['parent_id'];
		   $category->name = $data['category_name'];
		   $category->description = $data['description'];
		   $category->url = $data['url'];
		   $category->save();
		   return back()->with('flash_message_success', 'Category added successfully');
		   
	   }
	   $levels = Category::where(['parent_id'=>0])->get();
	   return view('admin.categories.add_category')->with(compact('levels'));
	   
   }
   
   public function viewCategory(){
	   $categories = Category::get();
	   return view('admin.categories.view_categories')->with(compact('categories'));
   }
   
   public function editCategory(Request $request, $id = null){
	   if($request->isMethod('post')){
		   $data = $request->all();
		   //echo "<pre>";print_r($data);die;
		   Category::where(['id'=>$id])->update( ['name'=>$data['category_name'],'parent_id'=>$data['parent_id'], 'description'=>$data['description'], 'url'=>$data['url'] ]);
			return back()->with('flash_message_success', 'Category Updated successfully');
	   }
	   $categoryDetails = Category::where(['id'=>$id])->first();
	   $levels = Category::where(['parent_id'=>0])->get();
	   return view('admin.categories.edit_category', compact('categoryDetails','levels'));
   }
   
   public function deleteCategory(Request $request, $id = null){
	   if(!empty($id)){
		   Category::where(['id'=>$id])->delete();
		  return back()->with('flash_message_success', 'Category Deleted successfully');
	   }
   }
   
}
