@extends('layouts.adminLayout.admin_design')

@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
    <h1>Add categories</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Add categories</h5>
          </div>
			  @if(Session::has('flash_message_success'))
			<div class="alert alert-success alert-block">
				<button type="button" class="close" data-dismiss="alert">×</button> 
					<strong>{!! session('flash_message_success') !!}</strong>
			</div>
			@endif    
          <div class="widget-content nopadding">
            <form class="form-horizontal" method="post" action="{{url('/admin/add-category')}}" name="add_category" id="add_category" novalidate="novalidate">
              @csrf
			  
			  <div class="control-group">
                <label class="control-label">categories Name</label>
                <div class="controls">
                  <input type="text" name="category_name" id="category_name">
                </div>
              </div>
			  
			   <div class="control-group">
                <label class="control-label">categories Levels</label>
                <div class="controls">
                  <select name="parent_id" id="parent_id" style="width:220px;">
					<option value="0">Main Category</option>
						@foreach($levels as $val)
							<option value="{{$val->id}}">{{$val->name}}</option>
						@endforeach
				  </select>
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
                <label class="control-label">URL (Start with http://)</label>
                <div class="controls">
                  <input type="text" name="url" id="url">
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