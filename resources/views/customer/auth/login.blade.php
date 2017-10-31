@extends('customer.layout.auth')

@section('title', 'Login')

@section('content')
<!-- banner-top -->
<div class="banner-top">
	<div class="container">
		<h3 >Login</h3>
		<h4><a href="{{ route('home') }}">Home</a><label>/</label>Login</h4>
		<div class="clearfix"> </div>
	</div>
</div>

<!--login-->

	<div class="login">
	
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Login</h3>
				    <form role="form" class="login-form cf-style-1" method="POST" action="{{ url('/customer/login') }}">
                        {{ csrf_field() }}
                        
                    
						<div class="field-row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                             <label for="email" class="control-label pull-left">E-Mail Address</label>
                                <input id="email" type="email" class="form-control  le-input" name="email" value="{{ old('email') }}" required autofocus>
                            
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <!-- /.field-row -->

                            <div class="field-row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                             <label for="password" class="control-label pull-left ">Password</label>
                                <input id="password" type="password" class="form-control   le-input" name="password" required>
                                
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        
                         <div class="field-row clearfix">
                                <span class="pull-left">
                        		<label class="content-color"><input type="checkbox" class="le-checbox auto-width inline"  name="remember"> <span class="bold" style="color:#606060;">Remember me</span></label>
                                </span>
                             <br/>
                             <br/>

                        </div>
                        <br/>
						<input type="submit" value="Login">
					</form>
				</div>
            <hr/>
				<div class="forg">
					<a href="{{ url('/customer/password/reset') }}" class="forg-left" style="letter-spacing:1px;font-size:16px;">Forgot Password ?</a>
					<a href="{{ url('customer/register') }}" class="forg-right" style="letter-spacing:1px;font-size:16px;"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a>
				<div class="clearfix"></div>
				</div>
			</div>
		</div>
<!-- ============================================================================== -->





<!-- Old Default Code
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/customer/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ url('/customer/password/reset') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->
@endsection
