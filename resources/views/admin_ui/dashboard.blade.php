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
     {!! Html::style('amcharts/plugins/export/export.css') !!} 
     {!! Html::style('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') !!}

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
@section('content')
        <div class="container-fluid">
            <div class="block-header">
                <h2>DASHBOARD</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">shopping_cart</i>
                        </div>
                        <div class="content">
                            <div class="text">ACTIVE ORDERS</div>
                            <div class="number count-to" data-from="0" data-to="125" data-speed="15" data-fresh-interval="20">{{ $order }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">view_quilt</i>
                        </div>
                        <div class="content">
                            <div class="text">STOCKS</div>
                            <div class="number count-to" data-from="0" data-to="257" data-speed="1000" data-fresh-interval="20">{{ $stock }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">attach_money</i>
                        </div>
                        <div class="content">
                            <div class="text">SALES</div>
                            <div class="number count-to" data-from="0" data-to="243" data-speed="1000" data-fresh-interval="20">{{ $sales_display }}</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">account_box</i>
                        </div>
                        <div class="content">
                            <div class="text">ACTIVE ACCOUNTS</div>
                            <div class="number count-to" data-from="0" data-to="1225" data-speed="1000" data-fresh-interval="20">{{ $user_email + $user_fb }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Widgets -->
            <!-- CPU Usage -->
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>SALES STATISTICS</h2>

                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                            </ul>
                        </div>
                        <div class="body" id="body">
                        <div id="chartdiv" style="height: 500px;"></div>   
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# CPU Usage -->
            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>PRODUCT STATISTICS</h2>

                                </div>
                            </div>
                            <ul class="header-dropdown m-r--5">
                            </ul>
                        </div>
                        <div class="body" id="body">
                        <div id="chartdiv4" style="height: 307px;"></div>   
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->
                <!-- Browser Usage -->
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="header">
                            <h2>ACTIVE ACCOUNTS STATISTICS</h2>
                        </div>
                        <div class="body">
                            <div id="chartdiv2" style="height: 312px;"></div> 
                        </div>
                    </div>
                </div>
                <!-- #END# Browser Usage -->
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>CUSTOMER INQUIRY</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table id="main" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th width="100">User ID</th>  
                                            <th width="150">Subject</th>
                                            <th width="150">Status</th>
                                            <th width="150">Action</th>           
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
        </div>
@section('additionalJS')
<script type="text/javascript">

var chartData = generateChartData();
var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 80,
    "autoMarginOffset": 20,
    "marginTop": 7,
    "dataProvider": chartData,
    "valueAxes": [{
        "axisAlpha": 0.2,
        "dashLength": 1,
        "position": "left"
    }],
    "mouseWheelZoomEnabled": true,
    "graphs": [{
        "id": "g1",
        "balloonText": "&#8369;[[value]]",
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "hideBulletsCount": 50,
        "title": "red line",
        "valueField": "visits",
        "useLineColorForBulletBorder": true,
        "balloon":{
            "drop":true
        }
    }],
    "chartScrollbar": {
        "autoGridCount": true,
        "graph": "g1",
        "scrollbarHeight": 40
    },
    "chartCursor": {
       "limitToGraph":"g1"
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisColor": "#DADADA",
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    }
});




// generate some random data, quite different range

// generate some random data, quite different range
function generateChartData() {
    var chartData = [];
    var sales = {!! json_encode($sales->toArray()) !!};
    $.each(sales, function(key, item) {
        var newDate = item.date;
        var visits = item.total;

            chartData.push({
            date: newDate,
            visits: visits
        });
    });
    return chartData;
}

</script>
<script type="text/javascript">
    var chart = AmCharts.makeChart("chartdiv2",
{
    "type": "serial",
    "theme": "light",
    "dataProvider": [{
        "name": "Via Facebook",
        "points": {!! $user_fb !!},
        "color": "#7F8DA9",
        "bullet": "https://cdn4.iconfinder.com/data/icons/social-media-icons-the-circle-set/48/facebook_circle-512.png"
    }, {
        "name": "Via Email",
        "points": {!! $user_email !!},
        "color": "#DB4C3C",
        "bullet": "https://nicolasersalefilms.files.wordpress.com/2015/08/gmail-icon.png"
    }],
    "valueAxes": [{
        "maximum": {!! $user_email + $user_fb + 1 !!},
        "minimum": 0,
        "axisAlpha": 0,
        "dashLength": 4,
        "position": "left"
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
        "bulletOffset": 10,
        "bulletSize": 52,
        "colorField": "color",
        "cornerRadiusTop": 8,
        "customBulletField": "bullet",
        "fillAlphas": 0.8,
        "lineAlpha": 0,
        "type": "column",
        "valueField": "points"
    }],
    "marginTop": 0,
    "marginRight": 0,
    "marginLeft": 0,
    "marginBottom": 0,
    "autoMargins": false,
    "categoryField": "name",
    "categoryAxis": {
        "axisAlpha": 0,
        "gridAlpha": 0,
        "inside": true,
        "tickLength": 0
    },
    "export": {
        "enabled": true
     }
}); 
    
     var table = $('#main').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('api.contactUs') }}",
        columns: [
            { data: 'user_id', name: 'user_id' },
            { data: 'subject', name: 'subject'},
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' }
        ]
    });

function deletes($id){
 
 swal({
        title: "Are you sure you want to remove?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes",
        closeOnConfirm: true,
    }, function () {
         var id = $id;
             $.ajax({
                    type: 'delete',
                    url: '/admin/contact_us/'+ id,
                    success: function(data) {
                        swal("Deleted!", "Customer Inquery has been removed.", "success");
                        table.ajax.reload();
                        }
                });
    });
}

</script>
<script type="text/javascript">
    
var chartData = [
    @php
    $category_each = DB::table('categories')->whereNull('deleted_at')->where('category_status','=',1)->select('category_name')->get();

    @endphp
    @foreach($category_each as $res)

    @php $count_category_each = DB::table('products')->whereNull('deleted_at')->where('product_status','=',1)->where('category_name','=',$res->category_name)->count(); @endphp

     { "title": "{{ $res->category_name}}",
     "value": {{ $count_category_each }},
     "url":"#",
     "description":"click to drill-down",
    "data": [
    @php $subcategory_each = DB::table('products')->whereNull('deleted_at')->where('product_status','=',1)->select('subcategory_name')->where('category_name','=',$res->category_name)->distinct()->get(); @endphp
    @foreach($subcategory_each as $res2)
    @php $count_subcategory_each = DB::table('products')->whereNull('deleted_at')->where('product_status','=',1)->where('subcategory_name','=',$res2->subcategory_name)->count(); @endphp
     { "title": "{{ $res2->subcategory_name}}", "value": {{ $count_subcategory_each }} },
    @endforeach
    ]},
@endforeach
]

// create pie chart
var chart = AmCharts.makeChart("chartdiv4", {
  "type": "pie",
  "dataProvider": chartData,
  "valueField": "value",
  "titleField": "title",
  "labelText": "[[title]]: [[value]]",
  "pullOutOnlyOne": true,
  "titles": [{
    "text": "Products Statistics"
  }],
  "allLabels": []
});

// initialize step array
chart.drillLevels = [{
  "title": "Products Statistics",
  "data": chartData
}];

// add slice click handler
chart.addListener("clickSlice", function (event) {
  
  // get chart object
  var chart = event.chart;
  
  // check if drill-down data is avaliable
  if (event.dataItem.dataContext.data !== undefined) {
    
    // save for back button
    chart.drillLevels.push(event.dataItem.dataContext);
    
    // replace data
    chart.dataProvider = event.dataItem.dataContext.data;
    
    // replace title
    chart.titles[0].text = event.dataItem.dataContext.title;
    
    // add back link
    // let's add a label to go back to yearly data
    event.chart.addLabel(
      0, 25, 
      "< Go back",
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      undefined, 
      'javascript:drillUp();');
    
    // take in data and animate
    chart.validateData();
    chart.animateAgain();
  }
});

function drillUp() {
  
  // get level
  chart.drillLevels.pop();
  var level = chart.drillLevels[chart.drillLevels.length - 1];
  
  // replace data
  chart.dataProvider = level.data;

  // replace title
  chart.titles[0].text = level.title;
  
  // remove labels
  if (chart.drillLevels.length === 1)
    chart.clearLabels();
  
  // take in data and animate
  chart.validateData();
  chart.animateAgain();
}

</script>

@endsection
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

    <!-- Jquery DataTable Plugin Js -->
    {{ Html::script('plugins/jquery-datatable/jquery.dataTables.js') }}
    {{ Html::script('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }}

    <!-- Demo Js -->
    {{ Html::script('js/demo.js') }}
    {{ Html::script('amcharts/amcharts.js') }}
    {{ Html::script('amcharts/serial.js') }}
    {{ Html::script('amcharts/plugins/export/export.min.js') }}
    {{ Html::script('amcharts/themes/light.js') }}
    {{ Html::script('amcharts/pie.js') }}   

@endsection