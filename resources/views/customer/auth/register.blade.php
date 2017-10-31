@extends('customer.layout.auth') 

@section('title', 'Register')

@section('content')
<!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >Register</h3>
		<h4><a href="{{ route('home') }}">Home</a><label>/</label>Register</h4>
		<div class="clearfix"> </div>
	</div>
</div>



<!--login-->

	<div class="login">
		<div class="main-agileits">
				<div class="form-w3agile form1">
					<h3>Register</h3>
                    <form role="form" class="register-form cf-style-1" method="POST" action="{{ url('/customer/register') }}">
                        {{ csrf_field() }}

                    <div class="field-row form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="control-label pull-left">Name</label>

                    <input id="name" type="text" class="form-control le-input" name="name" value="{{ old('name') }}" required autofocus> @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif

                    </div>



                        <div class="field-row form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label pull-left">E-Mail Address</label>


                            <input id="email" type="email" class="form-control le-input" name="email" value="{{ old('email') }}" required> @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif

                        </div>



                        <div class="field-row form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label pull-left">Password</label>


                            <input id="password" type="password" class="form-control le-input" name="password" required> @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif

                        </div>



                        <div class="field-row form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="control-label pull-left">Confirm Password</label>


                            <input id="password-confirm" type="password" class="form-control le-input" name="password_confirmation" required> @if ($errors->has('password_confirmation'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span> @endif

                        </div>
                        <br/>
						<input type="submit" value="Submit">
					</form>
				</div>
            <hr/>
				<div class="forg">
				
					<a href="{{ url('customer/login') }}" class="forg-right" style="letter-spacing:1px;margin-top:10px;font-size:16px;"><i class="fa fa-sign-in" aria-hidden="true"></i> LOGIN</a>
				<div class="clearfix"></div>
				</div>
			</div>
		</div>



<!-- Old Default Code
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/customer/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus> @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"> @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password"> @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"> @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span> @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
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