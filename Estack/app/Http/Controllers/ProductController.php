<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use Auth;
use Session;

use App\Product;
use App\Category;
use App\ProductsAttribute;

use Image;

class ProductController extends Controller
{
    public function addProduct(Request $request ,$id=null){
		
		if($request->isMethod('post')){
			$data=$request->all();
			//echo"<pre>";print_r($data);die;
			$product = new Product;
			$product->category_id = $data['category_id'];
			$product->product_name = $data['product_name'];
			$product->product_code = $data['product_code'];
			$product->product_color = $data['product_color'];
			$product->description = $data['description'];
			$product->price = $data['price'];
			
			//$product->image = '';
			if($request->hasFile('image')){
				 $image_tmp = Input::file('image');
				if($image_tmp->isValid()){
					//echo "test";die;
					$extension = $image_tmp->getClientOriginalExtension();
					$filename= rand(111,99999).'.'.$extension;
					$large_image_path = 'images/backend_images/products/large/'.$filename;
					$medium_image_path = 'images/backend_images/products/medium/'.$filename;
					$small_image_path = 'images/backend_images/products/small/'.$filename;
					
					//resize images
					
					Image::make($image_tmp)->resize(1200,1200)->save($large_image_path);
					Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
					Image::make($image_tmp)->resize(300,300)->save($small_image_path);
					
					//store image name products table
					$product->image = $filename;
					
				}
			}
			//end product image
			
			$product->save();
			return back()->with('flash_message_success', 'Product added successfully');
		}
		
		// Category drop down start
		$categories = Category::where(['parent_id'=>0])->get();
		$categories_dropdown = "<option selected disabled >Select</option>";
		
		foreach($categories as $cat){
			$categories_dropdown.="<option value='".$cat->id."'>".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
			
			foreach($sub_categories as $sub_cat){
				$categories_dropdown.= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
		}
		// Category drop down end
		
		return view('admin.products.add_product')->with(compact('categories_dropdown'));
	}
	
	public function viewProducts(){
		$products=Product::get();
		
		foreach($products as $key => $val){
			$category_name = Category::where(['id'=>$val->category_id])->first(); //confuse
			$products[$key]->category_name = $category_name->name;	//confuse
		}
		//echo "<pre>"; print_r($products);die;
		return view('admin.products.view_products')->with(compact('products'));
	}
	
	public function editProduct(Request $request, $id= null){
		
		if($request->isMethod('post')){
			
			$data = $request->all();
			// echo "<pre>";print_r($data);die;
			//$product->image = '';
			if($request->hasFile('image')){
				 $image_tmp = Input::file('image');
				
				if($image_tmp->isValid()){
					//echo "test";die;
					$extension = $image_tmp->getClientOriginalExtension();
					$filename= rand(111,99999).'.'.$extension;
					$large_image_path = 'images/backend_images/products/large/'.$filename;
					$medium_image_path = 'images/backend_images/products/medium/'.$filename;
					$small_image_path = 'images/backend_images/products/small/'.$filename;
					
					//resize images
					
					Image::make($image_tmp)->resize(1200,1200)->save($large_image_path);
					Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
					Image::make($image_tmp)->resize(300,300)->save($small_image_path);
					
	
				}
			}
			
			else{
				$filename = $data['current_image'];
			}
			//end edit product image
			
			Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'], 'product_name' =>$data['product_name'], 'product_code'=>$data['product_code'], 'product_color'=>$data['product_color'], 'description'=>$data['description'], 'price'=>$data['price'], 'image'=>$filename  ]);
			return back()->with('flash_message_success', 'product updated successfully');
		}
		 //echo "string";die;
		$productDetails = Product::where(['id'=>$id])->first();
		
		// Category drop down start
		$categories = Category::where(['parent_id'=>0])->get();
		$categories_dropdown = "<option selected disabled >Select</option>";
		
		foreach($categories as $cat){
			if($cat->id == $productDetails->category_id){
					$selected = 'selected';
			}
			else{
				$selected ='';
			}
			$categories_dropdown.="<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
			$sub_categories = Category::where(['parent_id'=>$cat->id])->get();
			
			foreach($sub_categories as $sub_cat){
				if($sub_cat->id == $productDetails->category_id){
					$selected = 'selected';
				}
				else{
					$selected ='';
				}
				$categories_dropdown.= "<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
			}
		}
		// Category drop down end
		
		return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
		
	}
	
	public function deleteProductImage($id = null){
		Product::where(['id'=>$id])->update(['image'=>'']);
		return back()->with('flash_message_success','product image has been deleted successfully');
	}
	
	public function deleteProduct($id = null){
		
		Product::where(['id'=>$id])->delete();
		return back()->with('flash_message_success','product has been deleted successfully');
	}
	
	public function addAttributes(Request $request, $id = null){
		//echo "test";die;
		$productDetails = Product::with('attributes')->where(['id'=>$id])->first();
		//$productDetails = json_decode(json_encode($productDetails));
		//echo"<pre>";print_r($productDetails);die;
		
		if($request->isMethod('post')){
			$data = $request->all();
			//echo "<pre>"; print_r($data);die;
			
			foreach($data['sku'] as $key => $val){
				if(!empty($val)){
					$attributes = new ProductsAttribute;
					$attributes->product_id = $id;
					$attributes->sku = $val;
					$attributes->size = $data['size'][$key];
					$attributes->price = $data['price'][$key];
					$attributes->stock = $data['stock'][$key];
					$attributes->save();
					
				}
			}
			return back()->with('flash_message_success','Product attributes added successfully ');
		}
		return view('admin.products.add_attributes')->with(compact('productDetails'));
	}
	
	public function deleteAttribute($id = null){
		ProductsAttribute::where(['id'=>$id])->delete();
		return back()->with('flash_message_success','Product attribute deleted successfully');
	}
	
}
