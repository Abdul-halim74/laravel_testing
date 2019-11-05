@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>Add Product Attribute</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product Attribute</h5>
          </div>
			  @if(Session::has('flash_message_success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{!! session('flash_message_success') !!}</strong>
			</div>
			@endif    
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-attributes/'.$productDetails->id)}}" name="add_product_attribute" id="add_product_attribute">
              @csrf
			  
			  <input type="hidden" name="product_id" value="{{$productDetails->id}}" />
			  <div class="control-group">
                <label class="control-label">Product Name</label>
                <label class="control-label"><strong>{{$productDetails->product_name}}</strong></label>
              </div>
			  
			  <div class="control-group">
                <label class="control-label">Product Code</label>
                <label class="control-label"><strong>{{$productDetails->product_code}}</strong></label>
              </div>
			  
			  <div class="control-group">
                <label class="control-label">Product Color</label>
                <label class="control-label"><strong>{{$productDetails->product_color}}</strong></label>
              </div>
			  
			 <div class="control-group">
                <label class="control-label"></label>
                <div class="field_wrapper">
					<div>
						<input type="text" name="sku[]" id="sku" placeholder="SKU"/ style="width:120px; ">
						<input type="text" name="size[]" id="size" placeholder="SIZE"/ style="width:120px; ">
						<input type="text" name="price[]" id="price" placeholder="price"/ style="width:120px; ">
						<input type="text" name="stock[]" id="stock" placeholder="stock"/ style="width:120px; ">
						<a href="javascript:void(0);" class="add_button" title="Add field">Add field</a>
					</div>
				</div>
              </div>
			  
              <div class="form-actions">
                <input type="submit" value="submit" class="btn btn-success">
              </div>
            </form>
          </div>
		   
        </div>
		
		<div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>view Attributes</h5>
          </div>
		   
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
				
				 <th>Attribute Id</th>
                  <th>SKU</th>
                  <th>SIZE</th>     
                  <th>price</th>
                  <th>Stock</th>                 
                  <th>Actions</th>
				  
                </tr>
              </thead>
              <tbody>
			  @foreach($productDetails['attributes'] as $attribute)
				<tr>
					<td>{{$attribute->id}}</td>
					<td>{{$attribute->sku}}</td>
					<td>{{$attribute->size}}</td>
					<td>{{$attribute->price}}</td>
					<td>{{$attribute->stock}}</td>
					<td><a id="delProduct" href="{{url('/admin/delete-attribute')}}/{{$attribute->id}}" class="btn btn-danger btn-mini">Delete</a></td>
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