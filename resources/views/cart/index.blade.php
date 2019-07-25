@extends('master_user1')

@section('content') 
<?php if ($cartItems->isEmpty()) {
    echo '<h1 align="center" style="padding-bottom:60px;"> - Cart is Empty - </h1>';
 ?>
<?php } else { ?>
    <section id="cart_items">
        <div class="container">
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
                     @foreach($cartItem as $cartItemss)
                        <tr>
                            <td class="cart_product">
                            <?php $pro_image = DB::table('product_images')->where('product_id','=',$cartItemss->id)->get()->take(1); ?>
                             @if(count($pro_image)>0)
                             @foreach($pro_image as $pro_image)
                                <a href=""><img src="/{{ $pro_image->image_path }}" style="width: 110px; height: 110px;" alt=""></a>
                             @endforeach
                             @else
                                <a href="/products/detail/{{ $cartItemss->id }}"><img src="user_ui/images/shop/No_Image_Available.jpg" style="width: 110px; height: 110px;" alt=""></a>
                             @endif
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $cartItemss->name }}</a></h4>
                                 @php $pro_qty = DB::table('products')->where('id','=',$cartItemss->id)->value('product_qty'); @endphp
                                <p>Only {{  $pro_qty }} left on stock.</p>
                            </td>
                            <td class="cart_price">
                                <p>&#8369; {{ number_format($cartItemss->price, 2, '.', '') }}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                  
                                <form id="form_validation" method="POST" action="/cart/update/{{ $cartItemss->rowId }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="producy_id" value="{{ $cartItemss->id }}">
                                 <input class="cart_quantity_input" id="qty" type="number" name="qty" value="{{ $cartItemss->qty }}" min="1" max="{{  $pro_qty }}" autocomplete="off" size="2" style=" width: 25px; ">
                                   <button type="submit" class="btn btn-success btn-sm" style="margin-left: 10px;">Update</button>
                                   </form>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">&#8369; {{ number_format($cartItemss->subtotal, 2, '.', ',') }}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="/cart/remove/{{ $cartItemss->rowId }}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section> 
    <section id="do_action">
        <div class="container">    
                <div class="col-sm-12">
                    <div class="total_area">
                        <ul>
                            <li>Cart Sub Total <span>&#8369; {{ Cart::subtotal() }}</span></li>
                            <li>Shipping Cost <span>&#8369; {{ number_format($ship_cost, 2, '.', '') }}</span></li>
                            @php $add = floatval($ship_cost);@endphp
                            <li>Total <span>&#8369; {{number_format($total, 2, '.', '')}}
                            </span></li>
                        </ul>
                            <a class="btn btn-default update" href="/products">Update</a>
                            <a class="btn btn-default check_out" href="/checkout">Check Out</a>
                    </div>
                </div>
            </div>
        </div>
    </section><!--/#do_action--> 
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
