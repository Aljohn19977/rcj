@extends('master_user')

@section('content')
<div class="col-sm-9 padding-right">
                    <div class="product-details"><!--product-details-->
                        <div class="col-sm-5">
                            <div class="view-product">
                             <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">

                <!-- Indicators -->
                <ol class="hidden-lg hidden-xs hidden-md carousel-indicators">
                     @foreach($product as $products)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                     @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" style="height: 449px;">




                    @if(count($productimage) >0 )
                         @foreach( $productimage as $element)
                        <div class="item {{ $loop->first ? ' active' : '' }}" >
                        <div class="col-sm-12">
                            <img src="/{{ $element->image_path }}" class="newarrival" alt="" class="newarrival" style="height: 449px; width: 329px;">
                        </div>
                        </div>
                         @endforeach
                         <!-- pra kung wla kang picture. wla lang sya idisplay. -->
                    @else
                        <div class="item active" >
                            <img src="/user_ui/images/shop/No_Image_Available1.jpg" class="newarrival" alt="" class="newarrival" style="height: 449px; width: 329px;">
                        </div>
                    @endif
                </div>
                        <a href="#carousel-example-generic" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#carousel-example-generic" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
            </div>                                   
                        </div>
                        </div>
                        <div class="col-sm-7">
                        <div id="error_qty">
                        </div> 

                         @foreach($product as $products)   

                            <div class="product-information"><!--/product-information-->
                            @php
                                if ($products->product_sale == 1){
                                    @endphp
                                         <img src="https://gnomes.co.nz/images/banner-sale.png" style="height: 66px; width: 132px;" class="newarrival" alt="">
                                    @php
                                }
                            @endphp

                                <h2>{{ ucwords($products->product_name) }} 

                            @php
                                if ($products->product_sale == 1){
                                    @endphp
                                         <span>is {{$products->product_percent}}% off.</span>
                                    @php
                                }else{
                                @endphp

                                @php
                                }
                            @endphp
                                


                                </h2>
                                <span>
                            @php
                              if ($products->product_sale == 1){
                                    @endphp
                                    <span style="color:#696763;"><strike>&#8369;{{ number_format($products->product_price, 2, '.', '') }}</strike></span>
                                    @php
                                        $sale_percent = $products->product_percent / 100;
                                        $price = $products->product_price * $sale_percent;
                                        $new_price = $products->product_price - $price;
                                    @endphp
                                    <span>&#8369;{{ number_format($new_price, 2, '.', '') }}</span>
                                    @php
                                }else{
                                @endphp
                                    <span>&#8369;{{ number_format($products->product_price, 2, '.', '') }}</span>
                                @php
                                }
                            @endphp
                                   
                            @php
                                 if ($products->product_qty >= 1){
                                    @endphp
                                         <label>Quantity:</label>
                                   <!--    <form id="form_validation" method="POST" action="/cart/addItem/pro_detail"> -->
                                        <input type="text" type="number" name="qty" id="qty" value="1">
                                    @php
                                 }
                            @endphp
                                 <input type="hidden" name="pro_id" id="pro_id" value="{{ $products->id }}">
                                 <input type="hidden" name="pro_name" id="pro_name" value="{{ $products->product_name }}">
                                <input type="hidden" name="pro_status" id="pro_status" value="{{ $products->product_status }}">
                               <input type="hidden" name="cat_id" id="cat_id" value="{{ $products->category_id }}">
                               <input type="hidden" name="subcat_id" id="subcat_id" value="{{ $products->subcategory_id }}">
                            @php
                                 if ($products->product_qty >= 1){
                                    @endphp
                                     <button class="btn btn-default cart" id="carts" style="margin-top:4px;"><i class="fa fa-shopping-cart"></i> Add to cart</button>
                                    @php
                                 }
                            @endphp
                                  <!--  </form> -->
                                </span>



                                <p><b>Availability:</b> 
                                @if($products->product_qty == 1)

                                    Only 1 left in stock
                                @elseif($products->product_qty == 0)
                                <span style="color:red;">Out of Stock</span>
                                @elseif ($products->product_qty == 2)
                                Only 2 left in stock
                                @elseif ($products->product_qty == 3)
                                Only 3 left in stock
                                @elseif ($products->product_qty == 4)
                                Only 4 left in stock
                                @elseif ($products->product_qty == 5)
                                Only 5 left in stock
                                @else
                                In stock


                                @endif
                               
                                </p>
                                <p><b>Category: </b>{{ ucwords($products->category_name) }}</p>
                                <p><b>Sub - Category: </b>{{ ucwords($products->subcategory_name) }}</p>
                                <p><b>Description</b></p>
                                <p>{{ $products->product_desc }}</p>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified" id="wishlist_ul">
                                         @if (Auth::guest())
                                            <li><a href="/login"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>                 
                                         @else
                                         <?php $wishlist = DB::table('wishlists')->where('product_id','=',$products->id)->where('user_id','=',Auth::user()->id)->count(); 

                                         if($wishlist=="0"){?>

                                            <li><a id="add_wishlist" style="cursor:pointer;"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>

                                         <?php }else{ ?>

                                            <li><a href="/wishlist"><i class="fa fa-check-square"></i>Already in wishlist</a></li>
                                         <?php }

                                         ?>

                                            
                                         @endif


                                        
                                    </ul>
                                </div>
                            </div><!--/product-information-->
                            @endforeach
                        </div>
                    </div><!--/product-details-->

{{ csrf_field() }}
@endsection

@section('additionalJS')

<script type="text/javascript">

$(document).ready(function(){

    //add to cart logic
    $(document).on('click','#carts',function(event){

        var product_id = $("#pro_id").val();
        
        var requested_qty = $("#qty").val();

        if (requested_qty % 1 != 0) {
             $('#error_qty').html('<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> Your inputted value is not valid.</div>');
                    window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                        }, 5000);
                    $('#qty').val(1);
        }else if(requested_qty<=0){
            $('#error_qty').html('<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> Your inputted value is not valid.</div>');
                    window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                        }, 5000);
                    $('#qty').val(1);
        }else {
            
        
        $.get("{{URL::to('/')}}/products/detail/"+product_id+"/json",function(data){
            
            var availableStock = data['qty'];

            if(requested_qty>availableStock) 
            {
                $('#error_qty').html('<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> You cannot add that amount to the cart — we have only '+availableStock+' in stock.</div>');
                    window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                    $(this).remove(); 
                                });
                            }, 5000);
                    $('#qty').val(1);
            }
            else
            {
                //add to cart 
                $.get("{{URL::to('/')}}/cart/addItem",
                {

                    "_token": $('input[name=_token]').val(),

                    "product_id": product_id,
                    "requested_qty": requested_qty,
                }
                    ,function(data, textStatus, xhr){
                        if(data['error']==1){
                             $('#error_qty').html('<div class="alert alert-warning" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> You cannot add that amount to the cart — we have only '+availableStock+' in stock.</div>');
                               window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                            });
                        }, 5000);
                        }else{
                         $('#error_qty').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Done!</strong> Successfully added to your cart.</div>');
                               window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                            });
                        }, 5000);
                           }
                        $('.counts').html('<i class="fa fa-shopping-cart"></i> Cart('+data['cart_count']+')</a>');
                        $('#qty').val(1);

            
                });

            }

        });
    }
    });
    //end of add to cart logic

    //add to wishlist logic
    $(document).on('click','#add_wishlist',function(event){


        var product_id = $("#pro_id").val();
        var product_name = $("#pro_name").val();
        var product_status = $("#pro_status").val();
        var category_id = $("#cat_id").val();
        var subcategory_id = $("#subcat_id").val();

        $.post("{{URL::to('/')}}/wishlist/addItem/",
                {

                    "_token": $('input[name=_token]').val(),

                    "product_id": product_id,
                    "product_status": product_status,
                    "category_id": category_id,
                    "subcategory_id": subcategory_id,
                }
                    ,function(data, textStatus, xhr){
                        $('#wishlist_ul').html('<li><a href="/wishlist"><i class="fa fa-check-square"></i>Already in wishlist</a></li>');
                        $('#wishlist_count').html('<a href="/wishlist"><i class="fa fa-star"></i> Wishlist('+data['wishlist_count']+')</a>');
                        $('#error_qty').html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Done!</strong> '+product_name+' is added on your wishlist.</div>');
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                            });
                        }, 3000);
                });
               
    });
    //end to wishlist logic

});
  </script>

@endsection