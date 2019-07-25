<!DOCTYPE html>
<html>
@include('partials._user_ui_head')
<body>	
@include('partials._user_ui_header')
@yield('carousel')
	<section>
		<div class="container">
			<div class="row">
			@yield('content')			
			</div>
		</div>
	</section>
	@include('partials._user_ui_footer')		
	@include('partials._user_ui_script')	
<script>

<?php $pro = DB::table('products')->where('product_status','=',"1")->whereNull('deleted_at')->get()->take(5); ?>

$(function(){

         var source = [
             @foreach($pro as $pros)
            { 
                value2: "<?php echo url('/');?>/products/search/<?php echo $pros->id;?>",
                label: "<?php echo $pros->product_name;?>",
            },
            @endforeach

         ];

 $("#proList").autocomplete({

     source: source,
     select: function(event, ui){
         window.location.href = ui.item.value2;
     }


 });
});
</script>

@yield('additionalJS')

</body>
</html>