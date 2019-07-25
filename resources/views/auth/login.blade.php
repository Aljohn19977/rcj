@extends('master_user1')

@section('content') 
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="login-form"><!--login form-->
                        <h2>Login or <span style="color:#953255;" >Sign Up</span></h2>
                        @if(Session::has('status'))
                       <div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Note! </strong> {{ Session::get('status') }}</div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="Email Address" />

                            @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                            
                            <input id="password" type="password" class="form-control" name="password" required placeholder="Password" />

                             @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                             @endif

                            <div class="col-sm-6">
                            <button type="submit" class="btn btn-default">Login</button>
                            </div>
                             <div class="col-sm-6">
                            <a class="btn btn-default regis pull-right" href="{{ route('register') }}">
                                    Register
                            </a>
                            </div>
                            <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                            </a>
                        </form>
                    </div><!--/login form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection

