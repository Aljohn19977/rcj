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
								<li>Sub - Category</li>
								<li class="active">Edit Sub Categories</li>					
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
                          <h2>EDIT SUB CATEGORY</h2>                            
                        </div>
                        <div class="body">
                            @if(count($errors) > 0)
                                @foreach($errors->all() as $error)
                                    <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{$error}}
                                </div>
                                @endforeach
                            @endif
                            <form id="form_validation" method="POST" action="/sub-category/{{ $subcategory->id }}" name="edit">

                            {{ method_field ('PUT') }}

                                {{ csrf_field() }}
                                <div class="form-group form-float">
                                <div class="row clearfix"> 
                                <div class="col-md-12">
                                    <h2 class="card-inside-title">Name</h2>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="subcategory_name" value="{{ $subcategory->subcategory_name}}" placeholder="Input category name." required>
                                    </div>
                                </div>         
                                </div> 
                                <div class="row clearfix">                            
                                    <div class="col-md-12">
                                    <h2 class="card-inside-title">Main Category</h2>
                                        <select class="form-control show-tick" name="category_id" id="name" required>    
                                            <option value="">Select Main Category</option>  
                                             @foreach($category as $category)
                                            <option value="{{ $category->id }}" data-name="{{ $category->category_name }}">{{ $category->category_name }}</option>
                                            @endforeach                          
                                        </select>
                                        <input type="hidden" id="category_name" name="category_name" value="{{ $subcategory->category_name}}" readonly="readonly">
                                    </div>   
                                </div>
                                <div class="row clearfix">                            
                                    <div class="col-md-12">
                                    <h2 class="card-inside-title">Publication Status</h2>
                                        <select class="form-control show-tick" name="subcategory_status" required>    
                                            <option value="">Select Publication Status</option>  
                                            <option value="1">Published</option>
                                            <option value="2">Unpublised</option>
                                        </select>
                                    </div>   
                                 </div>
                                <div class="row clearfix">
                                <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">                         
                                <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                                 <a href="/sub-category" class="btn btn-danger waves-effect pull-right" type="submit">CANCEL</a>
                                </div> 
                                </div>
                            </form>
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
            <script type="text/javascript">
                document.forms['edit'].elements['category_id'].value="{{ $subcategory->category_id }}";
                document.forms['edit'].elements['subcategory_status'].value="{{ $subcategory->subcategory_status }}";
            </script>
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
<script type="text/javascript">
$(document).ready(function() {  

$("#name option").filter(function() {    
       return $(this).val() == $("#category_name").val(); 
    }).attr('selected', true);  
 

    
$("#name").on("change", function() {

$("#category_name").val($(this).find("option:selected").data("name"));
});
}); 
</script>
@endsection