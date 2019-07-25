@extends('master_user1')

@section('content')
<div id="contact-page" class="container">
        <div class="bg">
            <div class="row">           
                <div class="col-sm-12">                         
                    <h2 class="title text-center">Contact <strong>Us</strong></h2>
                </div>                  
            </div>      
            <div class="row">   
                <div class="col-sm-8 col-sm-offset-2">
                    @if(Session::has('message'))
                        <div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> {{ Session::get('message') }}</div>
                    @endif
                      @if(Session::has('messages'))
                        <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note!</strong> {{ Session::get('messages') }}</div>
                    @endif
                    <div class="contact-form">
                        <form id="main-contact-form" class="contact-form row" name="contact-form" method="post" action="/contact_us/submit">
                        {{ csrf_field() }}
                            <div class="form-group col-md-6">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <input type="email" name="email" class="form-control" required="required" placeholder="E-mail (RCJ Fashion account login) ">
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" name="subject" class="form-control" required="required" placeholder="Subject">
                            </div>
                            <div class="form-group col-md-12">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your Message Here"></textarea>
                            </div>                        
                            <div class="form-group col-md-12">
                                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>              
            </div>  
        </div>  
    </div><!--/#contact-page-->
@endsection
@section('additionalJS')

<script type="text/javascript">

$(document).ready(function(){


           window.setTimeout(function() {
           $(".alert").fadeTo(500, 0).slideUp(500, function(){
           $(this).remove(); 
           });}, 3000);
});
  </script>

@endsection