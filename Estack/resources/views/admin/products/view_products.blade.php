@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Categories Tables</a> </div>
    <h1>view Products</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        @if(Session::has('flash_message_success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{!! session('flash_message_success') !!}</strong>
			</div>
			@endif    
			
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>view Products</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				
				 <th>Product Id</th>
                  <th>Category Id</th>
                  <th>Category Name</th>
                  <th>Product name</th>
                  <th>Product code</th>
                  <th>Product color</th>
                 
                  <th>price</th>
                  <th>Product Image</th>
                  <th>Actions</th>
				  
                </tr>
              </thead>
              <tbody>
			  @foreach($products as $product)
                <tr class="gradeX">
                  <td>{{$product->id}}</td>
                  <td>{{$product->category_id}}</td>
                  <td>{{$product->category_name}}</td>
                  <td>{{$product->product_name}}</td>
				  <td>{{$product->product_code}}</td>
                  <td>{{$product->product_color}}</td>
                  <td>{{$product->price}}</td>
                  <td>@if(!empty($product->image))<img width="100" src="{{asset('/images/backend_images/products/small/'.$product->image)}}" alt="Not found" /> @endif</td>
                  <td class="center"> 
				  
					<a href="#myModal{{$product->id}}" data-toggle="modal" class="btn btn-success btn-mini">View</a> |
					  <div id="myModal{{$product->id}}" class="modal hide">
						  <div class="modal-header">
							<button data-dismiss="modal" class="close" type="button">×</button>
							<h3>{{$product->product_name}} Full details here </h3>
						  </div>
						  <div class="modal-body">
						  
							<p>Product Id : {{$product->id}}</p>
							<p>Category Id : {{$product->category_id}}</p>
							<p>Product Code : {{$product->product_code}}</p>
							<p>Product Color : {{$product->product_color}}</p>
							<p>Product Price : {{$product->price}}</p>
							<p>Fabric : </p>
							<p>Material : </p>
							<p>Product Description : {{$product->description }}</p>
							
						  </div>
						</div>
				 
				  
				  <a href="{{url('/admin/edit-product')}}/{{$product->id}}" class="btn btn-primary btn-mini">Edit</a> | <a href="{{url('admin/add-attributes/')}}/{{$product->id}}"  class="btn btn-success btn-mini">Add</a> | <a id="delProduct" href="{{url('/admin/delete-product')}}/{{$product->id}}" class="btn btn-danger btn-mini">Delete</a>
				  
				  </td>
                </tr>
				
               @endforeach 
              </tbody> 
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection