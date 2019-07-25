@extends('master_user1')

@section('content')	
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->
						<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-12" style="padding-bottom: 80px;">
						<div class="bill-to">
							<p>Delivery Address</p>
								<form action="/checkout/add_address" method="POST">
                       				 {{ csrf_field() }}
									<div class="col-sm-6">
									<input type="text" name="name" class="fill_up" placeholder="Full Name">
									<input type="text" name="contact" class="fill_up" placeholder="Contact Number">
									<input type="text" name="landline" class="fill_up" placeholder="Landline">
									<input type="text" name="address1" class="fill_up" placeholder="Address 1">
									<input type="text" name="address2" class="fill_up" placeholder="Address 2">
									<input type="text" name="region" class="fill_up" placeholder="Region">
									<input type="text" name="city" class="fill_up" placeholder="City">
									<input type="text" name="barangay" class="fill_up" placeholder="Barangay">
									<input type="text" name="landmark" class="fill_up" placeholder="Landmark">
									</div>
									<div class="col-sm-6">
									<div class="order-message">
										<p>Delivery Instructions</p>
										<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
									</div>
									<div class="col-lg-6 col-lg-offset-4">
									<button class="btn btn-primary" href="">Save & Continue</button>
									</div>	
									</div>
								</form>
						</div>
					</div>				
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
<style type="text/css">
.fill_up{
background:#F0F0E9;
  border: 0 none;
  margin-bottom:10px;
  padding: 10px;
  width: 100%;
  font-weight: 300;
}
</style>
@endsection
