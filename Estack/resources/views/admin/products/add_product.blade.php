@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>Add Product</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add Product</h5>
          </div>
			  @if(Session::has('flash_message_success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{!! session('flash_message_success') !!}</strong>
			</div>
			@endif    
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{url('/admin/add-product')}}" name="add_product" id="add_product" novalidate="novalidate">
              @csrf
			  
			  <div class="control-group">
                <label class="control-label">Select Under category</label>
                <div class="controls">
                  <select name="category_id" id="category_id" style="width:220px;">
					<?php echo $categories_dropdown;  ?>
						
				  </select>
                </div>
              </div>
			
			  <div class="control-group">
                <label class="control-label">Product Name</label>
                <div class="controls">
                  <input type="text" name="product_name" id="product_name">
                </div>
              </div>
			  
			  <div class="control-group">
                <label class="control-label">Product Code</label>
                <div class="controls">
                  <input type="text" name="product_code" id="product_code">
                </div>
              </div>
			  
			  <div class="control-group">
                <label class="control-label">Product Color</label>
                <div class="controls">
                  <input type="text" name="product_color" id="product_color">
                </div>
              </div>
			  
			  
			  <div class="control-group">
                <label class="control-label">Description</label>
                <div class="controls">
                 
				  <textarea name="description" id="description" cols="30" rows="10">
					
				  </textarea>
                </div>
              </div>
			   
              <div class="control-group">
                <label class="control-label">price</label>
                <div class="controls">
                  <input type="text" name="price" id="price">
                </div>
              </div>
			  
			  <div class="control-group">
                <label class="control-label">image</label>
                <div class="controls">
                  <input type="file" name="image" id="image">
                </div>
              </div>
			  
              <div class="form-actions">
                <input type="submit" value="submit" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>
</div>

@endsection