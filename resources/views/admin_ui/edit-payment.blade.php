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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>PAYMENT INFORMATION</h2>           
                        </div>
                        <div class="body">
                        <form id="form_validation" name="T3" method="POST" action="/payment/{{ $payment->id }}">
                        {{ method_field ('PUT') }}
                                {{ csrf_field() }}
                         <div class="form-group form-float">
                                <div class="row clearfix">
                                <div class="col-md-4">
                                    <h2 class="card-inside-title">User ID</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{ $payment->user_id }}" disabled>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <h2 class="card-inside-title">Payment ID</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name."  value="{{ $payment->id }}" disabled>
                                    </div>
                                </div> 
                                <div class="col-md-4">
                                    <h2 class="card-inside-title">Amount</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{ $payment->amount }}" disabled>                                      
                                    </div>
                                </div>            
                                </div> 
                                <div class="row clearfix"> 
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Customer Name</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->name }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Email Address</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{ $user_email }}" disabled>
                                    </div>
                                </div>                                      
                                </div> 
                                <div class="row clearfix"> 
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Contact No.</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->contact }}" disabled>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <h2 class="card-inside-title">Landline No.</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->landline }}" disabled>
                                    </div>
                                </div>                                       
                                </div> 
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                    <h2 class="card-inside-title">Address No.1</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->address1 }}" disabled>
                                    </div>
                                    </div>   
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                    <h2 class="card-inside-title">Address No.2</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->address2 }}" disabled>
                                    </div>
                                    </div>   
                                </div>
                                <div class="row clearfix"> 
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Region</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->region }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">City</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->city }}" disabled>
                                    </div>
                                </div>           
                                </div> 
                                <div class="row clearfix"> 
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Barangay</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->barangay }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h2 class="card-inside-title">Landmark</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" placeholder="Input category name." value="{{  $payment->landmark }}" disabled>
                                    </div>
                                </div>           
                                </div> 
                                <div class="row clearfix">

                                <div class="col-md-6">
                                <h2 class="card-inside-title">Refund Status</h2>   

                                    @php
                                    if($payment->payment_type==1){ @endphp
                                    <select class="form-control show-tick" name="status" id="status" data-payment="1" data-status="1" required>                                                                            
                                    @php}else{@endphp
                                    <select class="form-control show-tick" name="status" id="status" data-payment="" data-status="" required>                                         
                                     @php}
                                     @endphp 

                                     @php
                                    if($payment->payment_type==1){ @endphp
                                    <option value="">Select Refund Status</option>
                                    <option value="1">Paid</option>
                                    <option value="2">Unpaid</option>
                                    @php}else if($payment->payment_type==2){@endphp
                                    <option value="" disabled="disabled">Select Refund Status</option>
                                    <option value="1">Paid</option>
                                    <option value="2" disabled="disabled">Unpaid</option>
                                    @php}
                                     @endphp                                                          
                                    </select>
                                </div>
                                <div class="col-md-6">
                                <h2 class="card-inside-title">Orders Status</h2>
                                    <select class="form-control show-tick" name="status_order" id="status_order" required>
                                        

                                    @php
                                    if($payment->payment_type==1 && $payment->payment_status==1){ @endphp
                                        <option value="">Select Order Status</option>                       
                                        <option value="1" disabled="disabled" id="pending">Pending</option>
                                        <option value="2" disabled="disabled" id="on_delivery">On Delivery</option>
                                        <option value="3" id="delivered">Delivered</option>                                    
                                    @php}else if($payment->payment_type==1 && $payment->payment_status==2){@endphp
                                        <option value="">Select Order Status</option>                       
                                        <option value="1" id="pending">Pending</option>
                                        <option value="2" id="on_delivery">On Delivery</option>
                                        <option value="3" id="delivered" disabled="disabled">Delivered</option> 
                                     @php}else if($payment->payment_type==2){@endphp
                                        <option value="">Select Order Status</option>                       
                                        <option value="1" id="pending">Pending</option>
                                        <option value="2" id="on_delivery">On Delivery</option>
                                        <option value="3" id="delivered">Delivered</option> 
                                     @php}
                                     @endphp          
                                    </select>
                                </div>  
                                 </div>
                                <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">                         
                                <button class="btn btn-success waves-effect" type="submit">UPDATE</button>
                                 <a href="/payment" class="btn btn-danger waves-effect pull-right" type="submit">CANCEL</a>
                                </div> 
                                </div>
                                </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
            </div>
        <!-- #END# Basic Validation -->
<script type="text/javascript">
    document.forms['T3'].elements['status'].value="{{ $payment->payment_status }}";
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

     <!-- Jquery DataTable Plugin Js -->
    {{ Html::script('plugins/jquery-datatable/jquery.dataTables.js') }}
    {{ Html::script('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}

    <!-- Custom Js -->
    {{ Html::script('js/admin.js') }}

    {{ Html::script('plugins/sweetalert/sweetalert.min.js') }}

    <!-- Demo Js -->
    {{ Html::script('js/demo.js') }}


@endsection