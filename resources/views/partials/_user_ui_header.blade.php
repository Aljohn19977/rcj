<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								@php 

								$landline =  DB::table('ship_social')->where('item','=',"landline")->value('value');

								$email =  DB::table('ship_social')->where('item','=',"email")->value('value'); 

								$facebook =  DB::table('ship_social')->where('item','=',"facebook")->value('value'); 

								$twitter =  DB::table('ship_social')->where('item','=',"twitter")->value('value'); 

								@endphp
								<li><a><i class="fa fa-phone"></i> {{ $landline }}</a></li>
								<li><a><i class="fa fa-envelope"></i> {{ $email }}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="{{ $facebook }}"><i class="fa fa-facebook"></i></a></li>
								<li><a href="{{ $twitter }}"><i class="fa fa-twitter"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							@php 
								$logo = DB::table('ship_social')->where('item','=','logo')->value('value')
							@endphp
							<a href="index.html"><img src="{{URL::to('/')}}/{{ $logo }}" alt="" style="width: 139px; height: 39px;"></a>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="/account"><i class="fa fa-user"></i> Account</a></li>
								 @if (Auth::guest())
                            
                       			 @else
                       			<?php $wishlist_count = DB::table('wishlists')->where('product_status','=',1)->where('user_id','=',$user_id = auth::user()->id)->count(); ?>
                       			 <li id="wishlist_count"><a href="/wishlist"><i class="fa fa-star"></i> Wishlist(<?php echo $wishlist_count; ?>)</a></li>
                       			 @endif
								 @if (Auth::guest())
                            
                       			 @else
                       			<?php $wishlist_count = DB::table('favorite_product')->where('product_status','=',1)->where('user_id','=',$user_id = auth::user()->id)->count(); ?>
                       			 <li id="wishlist_count"><a href="/favorites"><i class="fa fa-heart"></i> Favorites(<?php echo $wishlist_count; ?>)</a></li>
                       			 @endif                       			 
								
								<li><a href="/checkout"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="/cart" class="counts"><i class="fa fa-shopping-cart"></i> Cart({{Cart::count()}})</a></li>
								<li>

								 @if (Auth::guest())

                            		<li><a href="{{ url('/login') }}"><i class="fa fa-lock"></i> Login</a>
                            
                       			 @else

                       			 	<a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>


                       			 @endif

								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="/" class="active">Home</a></li>
								<li class="dropdown"><a href="/products">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="/products">All Products</a></li>
                                        <?php $cat = DB::table('categories')->where('category_status','=',"1")->get(); ?>
                                        @forelse($cat as $category) 				<li><a href="/products/{{ $category->category_name }}">{{ ucwords($category->category_name) }}</a></li>
						
										@empty
									
										@endforelse



                                    </ul>
                                </li> 
								<li><a href="/contact_us">Contact Us</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="{{ url('/search') }}" method="post">
		                        <input type="text" placeholder="Search" name="search_data" id="proList">
		                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   			</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->