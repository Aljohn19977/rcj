@extends('master_user1')

@section('content') 
<?php if ($favorites->isEmpty()) {
    echo '<h1 align="center" style="padding-bottom:60px;"> - Favorites is Empty - </h1>';
 ?>
<?php } else { ?>
<section id="cart_items">
		<div class="container">
			@if(Session::has('message'))
				<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> {{ Session::get('message') }}</div>
			@endif
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="total">Actions</td>
							<td class="total"></td>
						</tr>
					</thead>
					<tbody>
					  @foreach($favorites as $wishlist)
					  <?php 

					  		$pro_image = DB::table('product_images')->where('product_id','=',$wishlist->product_id)->get()->take(1); 
					  		$product = DB::table('products')->where('id','=',$wishlist->product_id)->get()->take(1); 

					  ?>
					   @foreach($product as $product)
						<tr>
							<td class="cart_product">
							 @if(count($pro_image)>0)
								 @foreach($pro_image as $pro_image)
                                  <a href=""><img src="/{{ $pro_image->image_path }}" style="width: 110px; height: 110px;" alt=""></a>
                            	 @endforeach
                            @else
                            	 <a href="/products/detail/{{ $wishlist->product_id }}"><img src="user_ui/images/shop/No_Image_Available.jpg" style="width: 110px; height: 110px;" alt=""></a>
                            @endif
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $product->product_name }}</a></h4>
								<p></p>
							</td>
							<td class="cart_price" style="padding-top: 15px;">
								<p>{{ $product->product_price }}</p>
							</td>
							</td>
							<td class="cart_total" style="padding-top: 30px;">
								<a href="/cart/addItem/favorites/{{ $wishlist->product_id }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</td>
							<td class="cart_delete" style="padding-top: 35px;">
								<a class="cart_quantity_delete" href="/favorites/remove/{{ $wishlist->user_id }}/{{ $wishlist->product_id }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<center><div class="col-lg-12">
						<ul class="pagination">
							{{$favorites->links()}}
						</ul>
				</div></center>
	</section> <!--/#cart_items-->
<?php } ?>
@endsection
@section('additionalJS')

<script type="text/javascript">

$(document).ready(function(){


           window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
           $(this).remove(); 
           });}, 3000);
});
  </script>

@endsection
