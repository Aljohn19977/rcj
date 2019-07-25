@extends('master_user1')

@section('content') 
    <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>New User Signup!</h2>
                        <form role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }} 
                            <input id="name" type="text" name="name"  placeholder="Name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif

                            <input id="email" type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif

                            <input id="password" placeholder="Password" type="password"  name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif

                            <input id="password-confirm"  placeholder="Confirm Password" type="password" name="password_confirmation" required>

                            <button type="submit" class="btn btn-default">Signup</button>
                        </form>
                    </div><!--/sign up form-->
            </div>
        </div>
    </section><!--/form-->
@endsection
