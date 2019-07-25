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
					<div class="col-sm-12" style="padding-bottom: 20px;">
						<div class="bill-to">
							<p>Primary Delivery Address</p>
								<form action="/checkout/add_address" method="POST">
                       				 {{ csrf_field() }}
									<div class="col-sm-6">
									<input type="text" name="name" value="{{ $address->name }}" class="fill_up" placeholder="Full Name">
									<input type="text" value="{{ $address->contact }}" name="contact" class="fill_up" placeholder="Contact Number">
									<input type="text" value="{{ $address->landline }}" name="landline" class="fill_up" placeholder="Landline">
									<input type="text" value="{{ $address->address1 }}" name="address1" class="fill_up" placeholder="Address 1">
									<input type="text" value="{{ $address->address2 }}" name="address2" class="fill_up" placeholder="Address 2">
									<input type="text" value="{{ $address->region }}" name="region" class="fill_up" placeholder="Region">
									<input type="text" value="{{ $address->city }}" name="city" class="fill_up" placeholder="City">
									<input type="text" value="{{ $address->barangay }}" name="barangay" class="fill_up" placeholder="Barangay">
									<input type="text" value="{{ $address->landmark }}" name="landmark" class="fill_up" placeholder="Landmark">
									</div>
									<div class="col-sm-6">
									<div class="order-message">
										<p>Delivery Instructions</p>
										<textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16">{{ $address->message }}</textarea>
									</div>
									<div class="col-lg-12">
									<button class="btn btn-primary" href="">Save & Continue</button>
									<a class="btn btn-primary" href="/checkout/seconday_address">Use Secondary Address</a>
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
