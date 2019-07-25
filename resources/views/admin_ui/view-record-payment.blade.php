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
                                <li><a href=""><i class="material-icons">attach_money</i> Payments and Refunds</a></li> 
                                <li>Payments</li>
                                <li class="active">Payment Records Table</li>
                            </ol>                        
                        </div>                 
                </div>
            </div>
            <!-- #END# Alignments -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                      
                            
                            <h2>
                                PAYMENT TABLE
                            </h2>
                      
                            </div>

                        
                        <div class="body">
                            <div class="table-responsive">
                                <table id="main-product" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Payment ID</th>
                                            <th>User ID</th>  
                                            <th>Payment Type</th>
                                            <th>Amount</th> 
                                            <th>Paid Date</th>                                            
                                        </tr>
                                    </thead>
                                    <tbody> 
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

            
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

    <!-- Custom Js -->
    {{ Html::script('js/admin.js') }}

    <!-- SweetAlert Plugin Js -->
   {{ Html::script('plugins/sweetalert/sweetalert.min.js') }}

<script>
  var table = $('#main-product').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.record') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user_id', name: 'user_id' },
            { data: 'payment_type', name: 'payment_type' },
            { data: 'amount', name: 'amount' },
            { data: 'deleted_at', name: 'deleted_at' }
        ]
    });
</script>

@endsection