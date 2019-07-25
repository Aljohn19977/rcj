@extends('master_user1')

@section('content')	
<section id="cart_items">
		<div class="container">
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
			@if(Session::has('message'))
                <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> {{ Session::get('message') }}</div>
            @endif
            @if(Session::has('message-errors'))
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> {{ Session::get('message-errors') }}</div>

            @endif
            @if(Session::has('message-unit'))
                <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> {{ Session::get('message-unit') }}</div>

            @endif
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
							 @foreach($cartItem as $cartItem)
						<tr>
							<td class="cart_product">
								<?php $pro_image = DB::table('product_images')->where('product_id','=',$cartItem->id)->get()->take(1); ?>
                             @if(count($pro_image)>0)
                             @foreach($pro_image as $pro_image)
                                <a href=""><img src="/{{ $pro_image->image_path }}" style="width: 110px; height: 110px;" alt=""></a>
                             @endforeach
                             @else
                                <a href="/products/detail/{{ $cartItem->id }}"><img src="/user_ui/images/shop/No_Image_Available.jpg" style="width: 110px; height: 110px;" alt=""></a>
                             @endif
							</td>



							<td class="cart_description">
								<h4><a href="">{{ $cartItem->name }}</a></h4>
                                 @php $pro_qty = DB::table('products')->where('id','=',$cartItem->id)->value('product_qty'); @endphp
                                <p>Only {{  $pro_qty }} left on stock.</p>
							</td>
							<td class="cart_price">
								<p>&#8369;{{ $cartItem->price }}</p>
							</td>
							<td class="cart_quantity">
								 <div class="cart_quantity_button">
                                  
                                <form id="form_validation" method="POST" action="/cart/update/{{ $cartItem->rowId }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="producy_id" value="{{ $cartItem->id }}">
                                 <input class="cart_quantity_input" type="number" name="qty" value="{{ $cartItem->qty }}" min="1" max="{{  $pro_qty }}" autocomplete="off" size="2" style=" width: 25px; ">
                                   <button type="submit" class="btn btn-success btn-sm" style="margin-left: 10px;">Update</button>
                                   </form>
                                </div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">&#8369;{{ $cartItem->subtotal }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="/cart/remove/{{ $cartItem->rowId }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>&#8369; {{ Cart::subtotal() }}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>&#8369; {{ $shipping_cost = number_format($ship_cost, 2, '.', '') }}</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>&#8369; {{ number_format(Cart::subtotal() + $shipping_cost, 2, '.', '') }}</span></td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="row"> 
				<div class="col-lg-12">
		            <div class="panel panel-default">
		              <div class="panel-heading" style="background-color: #953255; color:#fff; padding: 7px 15px; border-top-right-radius:0px; border-top-left-radius: 0px;"><h4 style="font-size: 16px; font-weight: normal;">Payment</h4></div>
		               <div class="panel-body">  
				       <div class="clear-fix"></div>
				       <form id="form_validation" method="POST" action="/checkout/orders/done">
				       {{ csrf_field() }}
						<ul>
							<li>
								<input type="hidden" name="total" value="{{ Cart::subtotal() + $shipping_cost }} ">
								<input type="radio"  name="payment" value="cod">
								<label for="payment_method_cod">
								Cash on delivery 	</label>
									<div class="payment_box payment_method_cod">
									<p>Pay with cash upon delivery.</p>
								</div>
							</li>
							<li>
							<input type="radio" name="payment" value="paypal" checked="checked">
							<label>
								PayPal <img src="http://towerofdoom.net/wp-content/plugins/woocommerce/includes/gateways/paypal/assets/images/paypal.png" alt="PayPal acceptance mark"><a href="https://www.paypal.com/ph/webapps/mpp/paypal-popup" onclick="javascript:window.open('https://www.paypal.com/ph/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;">What is PayPal?</a>	</label>
									<div style="display: none;">
									<p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
								</div>
							</li>
						</ul>
						<div class="clear-fix"></div>
						<button type="submit" id="cod" class="btn btn-success btn-lg" >Continue to order.</button>
						</form>
		            </div>
		            </div>
				</div>
			</div>
			</div>
		</div>
	</section> <!--/#cart_items-->

<style type="text/css">
.payment{
 color: #696763;
  font-size: 14px;
  font-weight: 300;
}
</style>
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