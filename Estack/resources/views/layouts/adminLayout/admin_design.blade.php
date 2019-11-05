<!DOCTYPE html>
<html lang="en">
<head>
	<title>Matrix Admin</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="{{asset('css/backend_css/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{asset('css/backend_css/bootstrap-responsive.min.css')}}" />

	<link rel="stylesheet" href="{{asset('css/backend_css/uniform.css')}}" />
	<link rel="stylesheet" href="{{asset('css/backend_css/select2.css')}}" />

	<link rel="stylesheet" href="{{asset('css/backend_css/fullcalendar.css')}}" />
	<link rel="stylesheet" href="{{asset('css/backend_css/matrix-style.css')}}" />
	<link rel="stylesheet" href="{{asset('css/backend_css/matrix-media.css')}}" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
	<link href="{{asset('fonts/backend_fonts/css/font-awesome.css')}}" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('css/backend_css/jquery.gritter.css')}}" />
	
</head>
<body>

@include('layouts.adminLayout.admin_header')
@include('layouts.adminLayout.admin_sidebar')


@yield('content')

<!--end-main-container-part-->

@include('layouts.adminLayout.admin_footer')


<script src="{{asset('js/backend_js/jquery.min.js')}}"></script> 
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div style="margin-left:180px;margin-top:20px;"><input type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;"/> <input type="text" name="size[]" id="size" placeholder="SIZE"/ style="width:120px; "> <input type="text" name="price[]" id="price" placeholder="price"/ style="width:120px; "> <input type="text" name="stock[]" id="stock" placeholder="stock"/ style="width:120px; "> <a href="javascript:void(0);" class="remove_button">Remove field</a></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script src="{{asset('js/backend_js/jquery.ui.custom.js')}}"></script> 
<script src="{{asset('js/backend_js/bootstrap.min.js')}}"></script> 
<script src="{{asset('js/backend_js/jquery.uniform.js')}}"></script> 
<script src="{{asset('js/backend_js/select2.min.js')}}"></script> 
<script src="{{asset('js/backend_js/jquery.validate.js')}}"></script> 
<script src="{{asset('js/backend_js/matrix.js')}}"></script> 
<script src="{{asset('js/backend_js/matrix.form_validation.js')}}"></script>

<script src="{{asset('js/backend_js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('js/backend_js/matrix.tables.js')}}"></script>
<script src="{{asset('js/backend_js/matrix.interface.js')}}"></script> 
<script src="{{asset('js/backend_js/matrix.popover.js')}}"></script>


<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

	// resets the menu selection upon entry to this page:
	function resetMenu() {
	   document.gomenu.selector.selectedIndex = 2;
	}
	
</script>


</body>
</html>
