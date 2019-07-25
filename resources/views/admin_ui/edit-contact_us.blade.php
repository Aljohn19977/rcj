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

    <!-- JQuery DataTable Css -->
     {!! Html::style('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') !!}
     {!! Html::style('plugins/sweetalert/sweetalert.css') !!}

    <!-- Dropzone Css -->
     {!! Html::style('plugins/dropzone/dropzone.css') !!}


@endsection

@section('content')
            <div class="block-header">
                <h2>ADVANCED FORM ELEMENTS</h2>
            </div>
            <!-- File Upload | Drag & Drop OR With Click & Choose -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2"">
                    <div class="card">
                        <div class="header">
                            <h2>
                                CUSTOMER - INQUERY
                            </h2>
                        </div>
                        <div class="body">
                        <div class="row clearfix">
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <div clas="container-fluid">
                             @if(Session::has('message'))
                                <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ Session::get('message') }}
                            </div>
                            @endif
                <form id="form_validation" method="POST" action="/admin/contact_us/reply"  name="add" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group form-float">
                                    <div class="row clearfix"> 
                                    <div class="col-md-6">
                                        <h2 class="card-inside-title">Name</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_name" placeholder="Input product name." value="{{ $ContactUs->name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h2 class="card-inside-title">Email</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="email" placeholder="Input product name." value="{{ $ContactUs->email }}" disabled>
                                        </div>
                                    </div>                                              
                                    </div> 
                                    <div class="row clearfix"> 
                                    <div class="col-md-12">
                                        <h2 class="card-inside-title">Subject</h2>
                                            <div class="form-line">
                                                <textarea name="subject" cols="30" rows="2" class="form-control no-resize" disabled>{{ $ContactUs->subject }}</textarea>
                                            </div>
                                    </div>         
                                    </div>
                                     <div class="row clearfix"> 
                                    <div class="col-md-12">
                                        <h2 class="card-inside-title">Message</h2>
                                            <div class="form-line">
                                                <textarea name="message" cols="30" rows="3" class="form-control" disabled>{{ $ContactUs->message }}</textarea>
                                            </div>
                                    </div>         
                                    </div>
                                    <h2 align="center" style="padding-top: 20px; padding-bottom: 20px; ">Reply to Customer Inquery</h2>
                                    <div class="row clearfix"> 
                                    <div class="col-md-12">
                                        <h2 class="card-inside-title">Message</h2>
                                            <div class="form-line">
                                                <textarea name="reply" cols="30" rows="2" class="form-control"></textarea>
                                            </div>
                                    </div>         
                                    </div>                                                <input type="hidden" name="user_id" value="{{ $ContactUs->user_id }}">  
                                    <input type="hidden" name="id" value="{{ $ContactUs->id }}">
                                    <input type="hidden" name="email" value="{{ $ContactUs->email }}"> 
                                    <input type="hidden" name="name" value="{{ $ContactUs->name }}">                  
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">                         
                                        <button class="btn btn-success waves-effect" type="submit">Submit</button>
                                         <a href="/admin/contact_us/" class="btn btn-danger waves-effect pull-right" type="submit">CANCEL</a>
                                    </div> 
                                </div>
                                </form>
                                </div>
                                </div>
                                </div>
                        </div>
                    </div>
                </div>
            <!-- #END# File Upload | Drag & Drop OR With Click & Choose -->
        </div>

            
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
    {{ Html::script('plugins/jquery/jquery.js') }}


    <!-- Bootstrap Core Js -->
     {{ Html::script('plugins/bootstrap/js/bootstrap.js') }}

    <!-- Select Plugin Js -->
     {{ Html::script('plugins/bootstrap-select/js/bootstrap-select.js') }}

    <!-- Slimscroll Plugin Js -->
    {{ Html::script('plugins/jquery-slimscroll/jquery.slimscroll.js') }}

    <!-- Waves Effect Plugin Js -->
    {{ Html::script('plugins/node-waves/waves.js') }}

    <!-- Jquery DataTable Plugin Js -->
    {{ Html::script('plugins/jquery-datatable/jquery.dataTables.js') }}
    {{ Html::script('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}

     <!-- Dropzone Plugin Js -->
    {{ Html::script('plugins/dropzone/dropzone.js') }}

    <!-- Custom Js -->
    {{ Html::script('js/admin.js') }}

    <!-- SweetAlert Plugin Js -->
    {{ Html::script('plugins/sweetalert/sweetalert.min.js') }}
@endsection