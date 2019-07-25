@extends('master_admin')

@section('title','VIEW-CATEGORY')
@section('stylesheet')
    <!-- Bootstrap Core Css -->
     {!! Html::style('plugins/bootstrap/css/bootstrap.css') !!}

    <!-- Bootstrap Select Css -->
     {!! Html::style('plugins/bootstrap-select/css/bootstrap-select.css') !!}

    <!-- Waves Effect Css -->
     {!! Html::style('plugins/node-waves/waves.css') !!}

    <!-- Animation Css -->
     {!! Html::style('plugins/animate-css/animate.css') !!}

    <!-- Custom Css -->
     {!! Html::style('css/style.css') !!}

@endsection

@section('content')
         <!-- Alignments -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
                       
                        <div class="body">
                            <ol class="breadcrumb breadcrumb-col-pink">
                                <li><a href=""><i class="material-icons">widgets</i> Categories</a></li>
                                <li><i class="material-icons">archive</i> Main Category</li>
                                <li class="active"><i class="material-icons">add_box</i> Edit Main Categories</li>                  
                            </ol>                        
                        </div>                   
                </div>
            </div>
        <!-- #END# Alignments -->

        <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 col-lg-offset-3 col-md-offset-3">
                    <div class="card">
                        <div class="header">
                          <h2>EDIT ORDER</h2>                           
                        </div>
                        <div class="body">
                            <form id="form_validation" method="POST" action="/orders/{{ $order->id }}" name="edit">

                            {{ method_field ('PUT') }}

                                {{ csrf_field() }}
                                <div class="form-group form-float">
                                <div class="row clearfix"> 
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Order ID</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{ $order->id }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Payment ID</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{ $order->payment_id }}" disabled>
                                    </div>
                                </div>          
                                </div> 
                                <div class="row clearfix"> 
                                <div class="col-md-9">
                                    <h2 class="card-inside-title">Product Name</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{ $order->product_name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h2 class="card-inside-title">Qty</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{ $order->qty }}" disabled>
                                    </div>
                                </div>                                        
                                </div> 

                                <div class="row clearfix">

                                 <div class="col-md-6">
                                <h2 class="card-inside-title">Delivery Status</h2>
                                    <select class="form-control show-tick" name="status" id="status" required>
                                        <option value="1" disabled="disabled">Pending</option>
                                        <option value="2" disabled="disabled">On Delivery</option>
                                        <option value="3" disabled="disabled">Delivered</option>  
                                        <option value="4" disabled="disabled">Canceled</option>          
                                    </select>
                                </div> 
                                <div class="col-md-6">
                                <h2 class="card-inside-title">Payment Status</h2>
                                @php
                                    if($order->payment_status==1){ @endphp
                                    <input type="text" class="form-control" placeholder="Input category name." value="Paid" disabled>
                                @php}else if($order->payment_status==2){@endphp
                                     <input type="text" class="form-control" placeholder="Input category name." value="Unpaid" disabled>
                                @php}
                                @endphp                               
                                </div>                                 
                                 </div>
                                <div class="row clearfix">
                                <div class="col-md-5 col-sm-5">
                                </div>
                                <div class="col-md-2 col-sm-2">
                                 <a href="/canceled_orders" class="btn btn-success waves-effect pull-right" type="submit">BACK</a>
                                 </div>
                                <div class="col-md-5 col-sm-5">
                                </div>
                                </div> 
                                </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <!-- #END# Basic Validation -->
<script type="text/javascript">
    document.forms['edit'].elements['status'].value="{{ $order->status }}";
</script>            
            
@endsection

@section('side-menu')
          <div class="menu">
                <ul class="list">
                    <li class="header">MENU</li>
                    <li class="active">
                        <a href="/admin-dashboard">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">account_box</i>
                            <span>Accounts</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/accounts">Customer Accounts</a>
                            </li>
                            <li>
                                <a href="/account/admin">Admin Account</a>
                            </li>
                            <li>
                                <a href="/account/delivery">Delivery Account</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Products</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/product">View Products</a>
                            </li>
                            <li>
                                <a href="/product/create">Add Products</a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">widgets</i>
                            <span>Categories</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Main Category</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="/category">View Main Categories</a>
                                    </li>
                                    <li>
                                        <a href="/category/create">Add Main Categories</a>
                                    </li>                                  
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Sub - Category</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="/sub-category">View Sub - Categories</a>
                                    </li>
                                    <li>
                                        <a href="/sub-category/create">Add Sub - Categories</a>
                                    </li>     
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">shopping_cart</i>
                            <span>Orders</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/orders">Active Orders</a>
                            </li>
                            <li>
                                <a href="/canceled_orders">Canceled Orders</a>
                            </li>
                            <li>
                                <a href="/delivered/order">Delivered Orders</a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">attach_money</i>
                            <span>Payments and Refunds</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Payments</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="/payment">Active Payments Table</a>
                                    </li>
                                    <li>
                                        <a href="/records/payment">Payment Records Table</a>
                                    </li>                                  
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="menu-toggle">
                                    <span>Refunds</span>
                                </a>
                                <ul class="ml-menu">
                                    <li>
                                        <a href="/refund">Active Refunds Table</a>
                                    </li>
                                    <li>
                                        <a href="/records/refund">Refund Records Table</a>
                                    </li>     
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">contacts</i>
                            <span>Customer Inquiry</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/admin/contact_us/">View Customer Inquiry</a>
                            </li>
                        </ul>
                    </li> 
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">picture_in_picture</i>
                            <span>Content Management</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="/content_interface">Social Media & Information</a>
                            </li>
                            <li>
                                <a href="/carousel">Carousel Slider & Logo</a>
                            </li>
                        </ul>
                    </li> 
                    <li>
                        <a href="/ship_cost">
                            <i class="material-icons">local_shipping</i>
                            <span>Shipment Cost</span>
                        </a>
                    </li>   
                    <li>
                        <a href="/statistics">
                            <i class="material-icons">timeline</i>
                            <span>Statistics Report</span>
                        </a>
                    </li>                   
                </ul>
            </div>
@endsection

@section('script')

    <!-- Jquery Core Js -->
    {{ Html::script('plugins/jquery/jquery.min.js') }}


    <!-- Bootstrap Core Js -->
     {{ Html::script('plugins/bootstrap/js/bootstrap.js') }}

    <!-- Select Plugin Js -->
     {{ Html::script('plugins/bootstrap-select/js/bootstrap-select.js') }}

    <!-- Slimscroll Plugin Js -->
    {{ Html::script('plugins/jquery-slimscroll/jquery.slimscroll.js') }}

    <!-- Waves Effect Plugin Js -->
    {{ Html::script('plugins/node-waves/waves.js') }}

    <!-- Custom Js -->
    {{ Html::script('js/admin.js') }}


    <!-- Demo Js -->
    {{ Html::script('js/demo.js') }}
@endsection