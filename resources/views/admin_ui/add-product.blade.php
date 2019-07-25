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
         <!-- Alignments -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
                       
                        <div class="body">
                            <ol class="breadcrumb breadcrumb-col-pink">
                                <li><a href=""><i class="material-icons">view_list</i> Product</a></li> 
                                <li>Add Products</li>                               
                            </ol>                        
                        </div>                   
                </div>
            </div>
            <!-- #END# Alignments -->
            <!-- File Upload | Drag & Drop OR With Click & Choose -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-lg-offset-2 col-md-offset-2"">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD PRODUCT
                            </h2>
                        </div>
                        <div class="body">
                        <div class="row clearfix">
                             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                             <div clas="container-fluid">
                            @if(Session::has('message'))
                                <div class="alert bg-red alert-dismissible" role="alert">
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
                <form id="form_validation" method="POST" action="/product"  name="add" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                    <div class="form-group form-float">
                                    <div class="row clearfix"> 
                                    <div class="col-md-12">
                                        <h2 class="card-inside-title">Name</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_name" placeholder="Input product name." value="{{ Request::old('product_name') }}" required>
                                        </div>
                                    </div>         
                                    </div> 
                                    <div class="row clearfix"> 
                                    <div class="col-md-12">
                                        <h2 class="card-inside-title">Product Description</h2>
                                            <div class="form-line">
                                                <textarea name="product_desc" cols="30" rows="5" class="form-control no-resize" required>{{ Request::old('product_desc')}}</textarea>
                                                <label class="form-label">Input product description</label>
                                            </div>
                                    </div>         
                                    </div> 
                                    <div class="row clearfix">                        
                                        <div class="col-md-12">
                                        <h2 class="card-inside-title">Main Category</h2>
                                            <select class="form-control show-tick" name="category_id" id="category" required>    
                                                <option value="">Select Main Category</option>
                                                 @foreach($category as $category)  
                                                <option value="{{ $category->id}}" data-name="{{ $category->category_name }}">{{ $category->category_name}}</option>  
                                                @endforeach                   
                                            </select>
                                            <input type="hidden" id="category_name" name="category_name" readonly="readonly">
                                        </div>   
                                    </div>
                                    <div class="row clearfix">                            
                                        <div class="col-md-12">
                                        <h2 class="card-inside-title">Sub - Category</h2>
                                            <select class="form-control input" name="subcategory_id" id="subcategory" required>    
                                                       
                                            </select>
                                            <input type="hidden" id="subcategory_name" name="subcategory_name" readonly="readonly">
                                     
                                        </div>   
                                    </div>
                                    <div class="row clearfix" style="padding-top: 20px;"> 
                                    <div class="col-md-4">
                                        <h2 class="card-inside-title">Price</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_price" placeholder="Input price." value="{{ Request::old('product_price') }}" required>
                                        </div>
                                    </div> 
                                    <div class="col-md-3">
                                        <h2 class="card-inside-title">Quantity</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_qty" placeholder="Input quantity." value="{{ Request::old('product_qty') }}" required>
                                        </div>
                                    </div> 
                                     <div class="col-md-5">
                                        <h2 class="card-inside-title">Publication Status</h2>
                                            <select class="form-control show-tick" name="product_status" required>    
                                                <option value="">Select Publication Status</option>  
                                                <option value="1">Published</option>
                                                <option value="2">Unpublised</option>
                                            </select>
                                        </div>            
                                    </div>
                               
                                 <div class="row clearfix">
                                    <div class="col-md-4 col-sm-6">    
                                         <h2 class="card-inside-title">Product Images (329 x 449px)</h2>
                                        <div class="form-line">
                                    <input type="file" name="file[]" multiple required>                              
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <h2 class="card-inside-title">Product Sale</h2>
                                            <select class="form-control show-tick" name="product_sale" required>    
                                                <option value="">Select Product Sale Status</option>  
                                                <option value="1">On Sale</option>
                                                <option value="2">Not On Sale</option>
                                            </select>
                                    </div> 
                                     <div class="col-md-3">
                                        <h2 class="card-inside-title">Percent off %</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_percent" placeholder="Input percent off." value="{{ Request::old('product_percent') }}" required>
                                        </div>
                                    </div>                                      
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">                         
                                        <button class="btn btn-success waves-effect" type="submit">SUBMIT</button>
                                         <a href="/product" class="btn btn-danger waves-effect pull-right" type="submit">CANCEL</a>
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
            <script type="text/javascript">
            document.forms['add'].elements['product_status'].value="{{ Request::old('product_status') }}";
             document.forms['add'].elements['product_sale'].value="{{ Request::old('product_sale') }}";
            </script>   
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
<script>
$('#category').on('change',function(e){
    console.log(e);

    var cat_id = e.target.value;

    $.get('/ajax-subcat?cat_id=' + cat_id, function(data){
        $('#subcategory').empty();
        $('#subcategory').append('<option value="">Select Sub - Category</option>');
        $.each(data, function(index, subcatObj){
            $('#subcategory').append('<option value="'+subcatObj.id+'" data-name="'+subcatObj.subcategory_name+'">'+subcatObj.subcategory_name+'</option>');
        });

        $('#subcategory')
        .selectpicker('refresh');
    });
});

</script>
<script type="text/javascript">
    $(document).ready(function() {  
        $("#category option").filter(function() {    
               return $(this).val() == $("#category_name").val(); 
            }).attr('selected', true);  
         

            
        $("#category").on("change", function() {

        $("#category_name").val($(this).find("option:selected").data("name"));
        });
    }); 
</script>

<script type="text/javascript">
    $(document).ready(function() {  
        $("#subcategory option").filter(function() {    
               return $(this).val() == $("#subcategory_name").val(); 
            }).attr('selected', true);  
         

            
        $("#subcategory").on("change", function() {

        $("#subcategory_name").val($(this).find("option:selected").data("name"));
        });
    }); 
</script>



@endsection