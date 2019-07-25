@extends('master_user')

@section('carousel')

<section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                             <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="false">

                <!-- Indicators -->
                <ol class="hidden-lg hidden-xs hidden-md carousel-indicators">
                     @foreach($product as $products)
                        <li data-target="#carousel-example-generic" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                     @endforeach
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" style="height: 441px;">
                    @if(count($productimage) >0 )
                         @foreach( $productimage as $element)
                        <div class="item {{ $loop->first ? ' active' : '' }}" >
                        <div class="col-sm-12">
                            <img src="/{{ $element->image_path }}" class="girl img-responsive" alt=""  style="height: 441px; width: 1200px;">
                        </div>
                        </div>
                         @endforeach
                         <!-- pra kung wla kang picture. wla lang sya idisplay. -->
                    @else
                        <div class="item active" >
                            <img src="/user_ui/images/shop/No_Image_Available1.jpg" class="newarrival" alt="" class="girl img-responsive" style="height: 441px; width: 1200px;">
                        </div>
                    @endif
                </div>
                        <a href="#carousel-example-generic" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#carousel-example-generic" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right" style="position: absolute;"></i>
                        </a>
            </div>   
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
@endsection
@section('content')
<div class="col-sm-9 padding-right">
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">RECENT PRODUCTS</h2>
                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active"> 
                                <?php $pro_recent1 =  DB::table('products')->orderBy('created_at','desc')->where('product_status','=',"1")->where('deleted_at', '=' , null)->get()->take(3); ?>  
                                    @foreach( $pro_recent1 as $pro_recent11)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    @php 
                                                        $pro_image = DB::table('product_images')->where('product_id','=',$pro_recent11->id)->first(); 

                                                        $pro_count = DB::table('product_images')->where('product_id','=',$pro_recent11->id)->count();
                                                        if($pro_count==0){ @endphp
                                                            <a href="products/detail/{{ $pro_recent11->id }}"><img src="/user_ui/images/shop/No_Image_Available1.jpg" alt="" style="width: 285px; height: 380px;"></a>
                                                       @php }else{ @endphp
                                                        
                                                            <a href="products/detail/{{ $pro_recent11->id }}"><img src="/{{ $pro_image->image_path }}" alt="" style="width: 285px; height: 380px;"></a>
                                                      @php  }
                                                    @endphp

                                              
                                                    <a href="products/detail/{{ $pro_recent11->id }}"><h2>&#8369;{{ $pro_recent11->product_price }}</h2></a>
                                                    <a href="products/detail/{{ $pro_recent11->id }}"><p>{{ $pro_recent11->product_name }}</p></a>
                                                    <a href="products/detail/{{ $pro_recent11->id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View Product</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="item">  
                                <?php $pro_recent2 =  DB::table('products')->orderBy('created_at','desc')->where('product_status','=',"1")->where('deleted_at', '=' , null)->skip(3)->take(3)->get(); ?>  
                                    @foreach( $pro_recent2 as $pro_recent22)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">

                                            

                                                    @php 
                                                        $pro_image = DB::table('product_images')->where('product_id','=',$pro_recent22->id)->first(); 

                                                        $pro_count = DB::table('product_images')->where('product_id','=',$pro_recent22->id)->count();
                                                        if($pro_count==0){ @endphp
                                                            <a href="products/detail/{{ $pro_recent22->id }}"><img src="/user_ui/images/shop/No_Image_Available1.jpg" alt="" style="width: 285px; height: 380px;"></a>
                                                       @php }else{ @endphp
                                                        
                                                            <a href="products/detail/{{ $pro_recent22->id }}"><img src="/{{ $pro_image->image_path }}" alt="" style="width: 285px; height: 380px;"></a>
                                                      @php  }
                                                    @endphp

                                             
                                                    <a href="products/detail/{{ $pro_recent22->id }}"><h2>&#8369;{{ $pro_recent22->product_price }}</h2></a>
                                                    <a href="products/detail/{{ $pro_recent22->id }}"><p>{{ $pro_recent22->product_name }}</p></a>
                                                    <a href="products/detail/{{ $pro_recent22->id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View Product</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                             <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">MOST VIEWED PRODUCTS</h2>
                        
                        <div id="recommended-item-carousel3" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active"> 
                                <?php $pro_recent1 =  DB::table('mv_products')->orderBy('views','desc')->where('product_status','=',1)->where('deleted_at', '=' , null)->get()->take(3); ?>  
                                    @foreach( $pro_recent1 as $pro_recent11)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    @php 
                                                        $pro_image = DB::table('product_images')->where('product_id','=',$pro_recent11->product_id)->first(); 

                                                        $pro_count = DB::table('product_images')->where('product_id','=',$pro_recent11->product_id)->count();
                                                        if($pro_count==0){ @endphp
                                                            <a href="products/detail/{{ $pro_recent11->product_id }}"><img src="/user_ui/images/shop/No_Image_Available1.jpg" alt="" style="width: 285px; height: 380px;"></a>
                                                       @php }else{ @endphp
                                                            <a href="products/detail/{{ $pro_recent11->product_id }}"><img src="/{{ $pro_image->image_path }}" alt="" style="width: 285px; height: 380px;"></a>
                                                            
                                                            
                                                      @php  }
                                                    @endphp

                                              
                                                    <a href="products/detail/{{ $pro_recent11->product_id }}"><h2>&#8369;{{ $pro_recent11->product_price }}</h2></a>
                                                    <a href="products/detail/{{ $pro_recent11->product_id }}"><p>{{ $pro_recent11->product_name }}</p></a>
                                                    <a href="products/detail/{{ $pro_recent11->product_id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View Product</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="item">  
                                <?php $pro_recent2 =  DB::table('mv_products')->orderBy('views','desc')->where('product_status','=',"1")->where('deleted_at', '=' , null)->skip(3)->take(3)->get(); ?>  
                                    @foreach( $pro_recent2 as $pro_recent22)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">

                                            

                                                    @php 
                                                        $pro_image = DB::table('product_images')->where('product_id','=',$pro_recent22->product_id)->first(); 

                                                        $pro_count = DB::table('product_images')->where('product_id','=',$pro_recent22->product_id)->count();
                                                        if($pro_count==0){ @endphp
                                                            <a href="products/detail/{{ $pro_recent22->product_id }}"><img src="/user_ui/images/shop/No_Image_Available1.jpg" alt="" style="width: 285px; height: 380px;"></a>
                                                       @php }else{ @endphp
                                                        
                                                            <a href="products/detail/{{ $pro_recent22->product_id }}"><img src="/{{ $pro_image->image_path }}" alt="" style="width: 285px; height: 380px;"></a>
                                                      @php  }
                                                    @endphp

                                             
                                                    <a href="products/detail/{{ $pro_recent22->product_id }}"><h2>&#8369;{{ $pro_recent22->product_price }}</h2></a>
                                                    <a href="products/detail/{{ $pro_recent22->product_id }}"><p>{{ $pro_recent22->product_name }}</p></a>
                                                    <a href="products/detail/{{ $pro_recent22->product_id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View Product</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                             <a class="left recommended-item-control" href="#recommended-item-carousel3" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel3" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">MOST FAVORITE PRODUCTS</h2>
                        
                        <div id="recommended-item-carousel2" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active"> 
                                <?php $mv_products3 =  DB::table('mf_products')->orderBy('counts','desc')->where('product_status','=',"1")->where('deleted_at', '=' , null)->get()->take(3);
                                ?>  
                                    @foreach($mv_products3 as $pro1)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    
                                                    @php 
                                                        $pro_image = DB::table('product_images')->where('product_id','=',$pro1->product_id)->first(); 

                                                         $pro_count = DB::table('product_images')->where('product_id','=',$pro1->product_id)->count();

                                                        if($pro_count==0){ @endphp
                                                            <a href="products/detail/{{ $pro1->product_id }}"><img src="/user_ui/images/shop/No_Image_Available1.jpg" alt="" style="width: 285px; height: 380px;"></a>
                                                       @php }else{ @endphp
                                                        
                                                            <a href="products/detail/{{ $pro1->product_id }}"><img src="/{{ $pro_image->image_path }}" alt="" style="width: 285px; height: 380px;"></a>
                                                      @php  }
                                                    @endphp

                                                    <a href="products/detail/{{ $pro1->product_id }}"><h2>&#8369;{{ $pro1->product_price }}</h2></a>
                                                    <a href="products/detail/{{ $pro1->product_id }}"><p>{{ $pro1->product_name }}</p></a>
                                                    <a href="products/detail/{{ $pro1->product_id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View Product</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="item">  
                                <?php $mf_products2 =  DB::table('mf_products')->orderBy('counts','desc')->where('product_status','=',"1")->where('deleted_at', '=' , null)->skip(2)->take(3)->get(); ?>  

                                    @foreach($mf_products2 as $pro2)
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">

                                             

                                                    @php 
                                                        $pro_image = DB::table('product_images')->where('product_id','=',$pro2->product_id)->first(); 

                                                        $pro_count = DB::table('product_images')->where('product_id','=',$pro2->product_id)->count();

                                                        if($pro_count==0){ @endphp
                                                            <a href="products/detail/{{ $pro2->product_id }}"><img src="/user_ui/images/shop/No_Image_Available1.jpg" alt="" style="width: 285px; height: 380px;"></a>
                                                       @php }else{ @endphp
                                                        
                                                            <a href="products/detail/{{ $pro2->product_id }}"><img src="/{{ $pro_image->image_path }}" alt="" style="width: 285px; height: 380px;"></a>
                                                      @php  }
                                                    @endphp
                                                    <a href="products/detail/{{ $pro2->product_id }}"><h2>&#8369;{{ $pro2->product_price }}</h2></a>
                                                    <a href="products/detail/{{ $pro2->product_id }}"><p>{{ $pro2->product_name }}</p></a>
                                                    <a href="products/detail/{{ $pro2->product_id }}" class="btn btn-default add-to-cart"><i class="fa fa-eye"></i>View Product</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                             <a class="left recommended-item-control" href="#recommended-item-carousel2" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                              </a>
                              <a class="right recommended-item-control" href="#recommended-item-carousel2" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                              </a>          
                        </div>
                    </div><!--/recommended_items-->

@endsection