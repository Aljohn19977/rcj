<!DOCTYPE html>
<html>

@include('partials._head')

<body class="theme-pink">
@include('partials._nav_delivery') 
    <!-- #Top Bar -->
    <section class="content">
        <div class="container-fluid">
         @yield('content')
         </div>
    </section>

@include('partials._left_sidebar_delivery')

@yield('script')
<script>
$('#status').on('change',function(e){
    console.log(e);
    var payment_type = $("#payment_type").val();
    var payment_status = $("#payment_status").val();

    var payment_type = e.target.getAttribute('data-payment');
    var payment_status = e.target.getAttribute('data-status');
    var cat_id = e.target.value;

    if(payment_type==1 && payment_status==1){
    if(cat_id==1){
        $("#pending").attr("disabled", "disabled");
        $("#on_delivery").attr("disabled", "disabled");
        $("#delivered").removeAttr("disabled", "disabled");
        $('#status_order').selectpicker('refresh');
    }
    else if(cat_id==2){

        $("#pending").removeAttr("disabled", "disabled");
        $("#on_delivery").removeAttr("disabled", "disabled");
        $("#delivered").attr("disabled", "disabled");
        $('#status_order').selectpicker('refresh');
    }
    }else{
    if(cat_id==1){
    	$("#pending").removeAttr("disabled", "disabled");
    	$("#on_delivery").removeAttr("disabled", "disabled");
    	$("#delivered").removeAttr("disabled", "disabled");
    	$('#status_order').selectpicker('refresh');
    }
    else if(cat_id==2){
    	$("#pending").removeAttr("disabled", "disabled");
    	$("#on_delivery").removeAttr("disabled", "disabled");
    	$("#delivered").attr("disabled", "disabled");
    	$('#status_order').selectpicker('refresh');
    }
}
    
});
</script>  
@yield('additionalJS')

</body>

</html>