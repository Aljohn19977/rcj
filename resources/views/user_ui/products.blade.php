@extends('master_user')

@section('content')
<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Products</h2>
						<?php $countP=0; ?>
						 @forelse($product as $products) 					
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
									<?php 
											$pro_id = $products->id
									?>
									<?php $pro_image = DB::table('product_images')->where('product_id','=',$pro_id)->first(); ?>
									 @if(count($pro_image)>0)
										<a href="/products/detail/{{ $products->id }}"><img src="/{{ $pro_image->image_path }}" alt="" style="width: 285px; height: 380px;"></a>
									@else
										<a href="/products/detail/{{ $products->id }}"><img src="/user_ui/images/shop/No_Image_Available2.jpg" alt="" style="width: 285px; height: 380px;"></a>
									@endif
										<a href="/products/detail/{{ $products->id }}"><h2>&#8369;{{ number_format($products->product_price, 2, '.', '') }}</h2></a>
										<a href="/products/detail/{{ $products->id }}"><p>{{ $products->product_name }}</p></a>
										<input type="hidden" id="pro_id<?php echo $countP; ?>" value="{{ $products->id }}">
										<a href="/products/detail/{{ $products->id }}" class="btn btn-default add-to-cart" id="carts<?php echo $countP; ?>"><i class="fa fa-eye"></i> View Product</a>
										</div>
										@php
											if($products->product_sale == 1){
											@endphp
											<img src="images/home/sale.png" class="new" alt="">
											@php
											}
										@endphp
										
								</div>

							</div>

						</div>
						<?php $countP++ ?>
						@empty
						<h4 class="text-center">- No Products Available -</h4>
						
						@endforelse
						<div class="col-lg-12">
						<ul class="pagination">
							<?php echo $product; ?>
						</ul>
						</div>
					</div><!--features_items-->
				</div>
@endsection