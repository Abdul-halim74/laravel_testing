<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


Route::get('/', function () {
    return view('welcome');
});

*/

Route::match(['get','post'],'/admin','AdminController@login');


Auth::routes();

Route::get('/home','HomeController@index');

Route::group(['middleware'=>['auth']], function(){
	
	Route::get('/admin/dashboard','AdminController@dashboard');
	Route::get('/admin/setting','AdminController@setting'); //without authenticated without access setting password
	Route::get('/admin/check-pwd','AdminController@chkPassword');
	Route::match(['get','post'],'/admin/update-pwd','AdminController@updatePassword');
	
	//Categories routes
	Route::match(['get','post'],'/admin/add-category','CategoryController@addCategory');
	Route::match(['get','post'],'/admin/edit-category/{id}','CategoryController@editCategory');
	Route::match(['get','post'],'/admin/delete-category/{id}','CategoryController@deleteCategory');
	
	Route::get('/admin/view-category','CategoryController@viewCategory');
	
	//products routes
	Route::match(['get','post'],'/admin/add-product','ProductController@addProduct');
	Route::match(['get','post'],'/admin/edit-product/{id}','ProductController@editProduct');
	Route::get('/admin/view-product','ProductController@viewProducts');
	Route::get('/admin/delete-product-image/{id}','ProductController@deleteProductImage');
	Route::get('/admin/delete-product/{id}','ProductController@deleteProduct');
	
	//Products Attribute routes
	Route::match(['get','post'],'/admin/add-attributes/{id}','ProductController@addAttributes');
	Route::get('/admin/delete-attribute/{id}','ProductController@deleteAttribute');
});


Route::get('/logout','AdminController@logout');



//Frontend Route start

Route::get('/','IndexController@index');
