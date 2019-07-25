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

        <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>EDIT PRODUCT</h2>                            
                        </div>
                        <div class="body">
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
                            <form id="form_validation" method="POST" action="/product/{{ $products->id }}" name="edit">

                            {{ method_field ('PUT') }}

                                {{ csrf_field() }}
                               <div class="form-group form-float">
                                    <div class="row clearfix"> 
                                    <div class="col-md-12">
                                        <h2 class="card-inside-title">Name</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_name" placeholder="Input product name." value="{{ $products->product_name }}" required>
                                        </div>
                                    </div>         
                                    </div> 
                                    <div class="row clearfix"> 
                                    <div class="col-md-12">
                                        <h2 class="card-inside-title">Product Description</h2>
                                            <div class="form-line">
                                                <textarea name="product_desc" cols="30" rows="5" class="form-control no-resize" required>{{ $products->product_desc }}</textarea>
                                                <label class="form-label">Input product description</label>
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
                                        <input type="hidden" id="category_name" name="category_name" value="{{ $products->category_name}}" readonly="readonly">
                                        </div>   
                                    </div>
                                    <div class="row clearfix">                            
                                        <div class="col-md-12">
                                        <h2 class="card-inside-title">Sub - Category</h2>
                                            <select class="form-control input" name="subcategory_id" id="subcategory" required>    
                                            <option value="{{ $products->subcategory_id
                                             }}">{{ $products->subcategory_name
                                             }}</option>
                                            </select>
                                            <input type="hidden" id="subcategory_name" name="subcategory_name" value="{{ $products->subcategory_name}}" readonly="readonly">
                                     
                                        </div>   
                                    </div>
                                    <div class="row clearfix" style="padding-top: 20px;"> 
                                    <div class="col-md-6">
                                        <h2 class="card-inside-title">Price</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_price" placeholder="Input price." value="{{$products->product_price}}" required>
                                        </div>
                                    </div> 
                                    <div class="col-md-6">
                                        <h2 class="card-inside-title">Quantity</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_qty" placeholder="Input quantity." value="{{ $products->product_qty }}" required>
                                        </div>
                                    </div>             
                                    </div>
                               
                                 <div class="row clearfix">
                                        <div class="col-md-12">
                                        <h2 class="card-inside-title">Publication Status</h2>
                                            <select class="form-control show-tick" name="product_status" required>    
                                                <option value="">Select Publication Status</option>  
                                                <option value="1">Published</option>
                                                <option value="2">Unpublised</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6">
                                        <h2 class="card-inside-title">Product Sale</h2>
                                            <select class="form-control show-tick" name="product_sale" required>    
                                                <option value="">Select Product Sale Status</option>  
                                                <option value="1">On Sale</option>
                                                <option value="2">Not On Sale</option>
                                            </select>
                                    </div> 
                                     <div class="col-md-6">
                                        <h2 class="card-inside-title">Percent off %</h2>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="product_percent" placeholder="Input percent off." value="{{ $products->product_percent }}" required>
                                        </div>
                                    </div>  
                                </div>
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-md-offset-3 col-sm-offset-3">                         
                                        <button class="btn btn-success waves-effect" type="submit">UPDATE</button>
                                         <a href="/product" class="btn btn-danger waves-effect pull-right" type="submit">CANCEL</a>
                                    </div> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                          <h2>PRODUCT IMAGES</h2>                            
                        </div>
                        <div class="body">
                        @if(Session::has('messages'))
                                <div class="alert bg-red alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                {{ Session::get('messages') }}
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
                        <form id="form_validation" method="POST" action="/product/image/upload"  name="add" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-6">    
                                    <h2 class="card-inside-title">Product Images (329 x 449px)</h2>
                                    <div class="form-line">
                                    <input type="file" name="file[]" multiple required>
                                    <input type="hidden" name="product_id" value="{{ $products->id }}">
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
                              <th>Action</th>
                             </tr>
                        </thead>
                        <tbody> 
                            <?php $count=0;?>
                            @foreach($productimage as $productimages)
                            <tr>
                                <td align="center"><img src="/{{ $productimages->image_path }}" style="width: 100px; height: 100px;" alt=""></td>
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
                document.forms['edit'].elements['category_id'].value="{{ $products->category_id }}";
                document.forms['edit'].elements['product_status'].value="{{ $products->product_status }}";
                document.forms['edit'].elements['product_sale'].value="{{ $products->product_sale }}";
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

     <!-- Jquery DataTable Plugin Js -->
    {{ Html::script('plugins/jquery-datatable/jquery.dataTables.js') }}
    {{ Html::script('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}

    <!-- Custom Js -->
    {{ Html::script('js/admin.js') }}

    {{ Html::script('plugins/sweetalert/sweetalert.min.js') }}

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
<script>
$('#name').on('change',function(e){
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
        $("#subcategory option").filter(function() {    
               return $(this).val() == $("#subcategory_name").val(); 
            }).attr('selected', true);  
         

            
        $("#subcategory").on("change", function() {

        $("#subcategory_name").val($(this).find("option:selected").data("name"));
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
                    url: '/product/image/delete/'+ pro_img_id<?php echo $i; ?>,
                    success: function(data) {
                        swal("Deleted!", "Image has been deleted.", "success");
                        table.row( $button.parents('tr') ).remove().draw();
                        }
                });
    });
        })
    <?php } ?>
    }); 


function deletes($id){
    
alert($id);
 swal({
        title: "Are you sure you want to delete?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: true,
    }, function () {
         var id = $id;
             $.ajax({
                    type: 'post',
                    url: '/product/image/delete/'+ id,
                    success: function(data) {
                        swal("Deleted!", "Category has been deleted.", "success");
                        return q();
                        }
                });
    });

       
};
</script>
@endsection