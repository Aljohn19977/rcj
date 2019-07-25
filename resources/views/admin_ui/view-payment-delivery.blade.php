@extends('master_admin_delivery')

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
            <!-- #END# Alignments -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                      
                            
                            <h2>
                                DELIVERY TABLE
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
                                            <th>Payment Status</th>
                                            <th>Action</th>                                            
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
                        <a href="/delivery/payment">
                            <i class="material-icons">local_shipping</i>
                            <span>Active Deliveries</span>
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
        ajax: "{{ route('api.delivery') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user_id', name: 'user_id' },
            { data: 'payment_type', name: 'payment_type' },
            { data: 'amount', name: 'amounte' },
            { data: 'payment_status', name: 'payment_status' },
            { data: 'action', name: 'action' }
        ]
    });
</script>

@endsection