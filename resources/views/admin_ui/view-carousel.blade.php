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
                                <li>Main Category</li>
                                <li class="active">Edit Main Categories</li>                  
                            </ol>                        
                        </div>                   
                </div>
            </div>
        <!-- #END# Alignments -->
            <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>CAROUSEL IMAGES</h2>                            
                        </div>
                        <div class="body">
                        @if(Session::has('messages'))
                                <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ Session::get('messages') }}
                            </div>
                        @endif
                        @if(Session::has('message'))
                                <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ Session::get('message') }}
                            </div>
                        @endif
                        @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{$error}}
                                </div>
                                @endforeach
                            @endif
                        <form id="form_validation" method="POST" action="/carousel/upload"  name="add" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">    
                                    <h2 class="card-inside-title">CAROUSEL IMAGES<span><br>(1200 x 441px)</span></h2>
                                    <div class="form-line">
                                    <input type="file" name="file[]" multiple required>
                                    <input type="hidden" name="product_id" value="">
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6" style="margin-top: 10px;"> 
                                <div class="form-line">
                                <h2 class="card-inside-title"></h2>
                                 <button class="btn btn-success waves-effect pull-left" type="submit">Upload</button>
                                 </div>
                                </div>
                            </div>
                        </form>
                            <div class="table-responsive">
                                <table id="main" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Image</th>  
                                            <th width="150">Action</th>                                     
                                        </tr>
                                    </thead>
                                    <tbody> 
                                    <?php $count=0;?>
                                        @foreach($productimage as $productimages)
                                        <tr>
                                            <td align="center"><img src="/{{ $productimages->image_path }}" style="width: 200px; height: 100px;" alt=""></td>
                                            <td><button id="q<?php echo $count; ?>" class="btn btn-danger waves-effect"><i class="material-icons">delete</i></button></td>
                                            <input type="hidden" id="pro_img_id<?php echo $count; ?>" value="{{ $productimages->id }}">
                                        </tr>
                                        <?php $count++; ?>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>WEB SITE LOGO</h2>                            
                        </div>
                        <div class="body">
                        @if(Session::has('message2'))
                                <div class="alert bg-green alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ Session::get('message2') }}
                            </div>
                        @endif
                        @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{$error}}
                                </div>
                                @endforeach
                            @endif
                        <form id="form_validation" method="POST" action="/logo/upload"  name="add" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">    
                                    <h2 class="card-inside-title">WEBSITE LOGO<span><br>(139 x 39px)</span></h2>
                                    <div class="form-line">
                                    <input type="file" name="file" required>
                                    </div>
                                </div> 
                                <div class="col-md-6 col-sm-6" style="margin-top: 10px;"> 
                                <div class="form-line">
                                <h2 class="card-inside-title"></h2>
                                 <button class="btn btn-success waves-effect pull-left" type="submit">Update</button>
                                 </div>
                                </div>
                            </div>
                        </form>
                            <div class="table-responsive">
                                <table id="main" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Image</th>                                       
                                        </tr>
                                    </thead>
                                    <tbody> 
                                    <?php $count=0;?>
                                        @foreach($logo as $productimages)
                                        <tr>
                                            <td align="center"><img src="/{{ $productimages->value }}" style="width: 200px; height: 100px;" alt=""></td>
                                            <input type="hidden" id="pro_img_id<?php echo $count; ?>" value="{{ $productimages->id }}">
                                        </tr>
                                        <?php $count++; ?>
                                        @endforeach
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <!-- #END# Basic Validation -->
            
            
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


<script type="text/javascript">
    
    var table = $('#main').DataTable();
    <?php $maxP = count($productimage); 
    for($i=0;$i<$maxP;$i++){?>
    $('#q<?php echo $i; ?>').click(function(){
        var pro_img_id<?php echo $i; ?> = $('#pro_img_id<?php echo $i; ?>').val();
        var $button = $(this);
        swal({
        title: "Are you sure you want to delete?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: true,
    }, function () {
        $.ajax({
                    type: 'post',
                    url: '/carousel/image/delete/'+ pro_img_id<?php echo $i; ?>,
                    success: function(data) {
                        swal("Deleted!", "Image has been deleted.", "success");
                        table.row( $button.parents('tr') ).remove().draw();
                        }
                });
    });
        })
    <?php } ?>

</script>
@endsection