
@extends('layouts.homeMaster')

@section('title','Your Account')

@section('page-specific-css')

        <script type="text/javascript"
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyABb1W2GhWNw14H5BVvA7AHHnLrEya2_TA&libraries=places">
    </script>
    
<!--    AIzaSyABb1W2GhWNw14H5BVvA7AHHnLrEya2_TA-->
@endsection

@section('body')
<!-- banner-top -->
<div class="banner-top">
	<div class="container">
		<h3>User Profile</h3>
<!--		<h4><a href="{{ route('home') }}">Home</a><label>/</label>Login</h4>-->
		<div class="clearfix"> </div>
	</div>
</div>


<div class="container-fluid">
    
    <div class="container">
        
        <div class="form-area">
        <form action="{{ url('customer/complete-your-profile') }}" method="post">
            {{ csrf_field() }}
            
            <div class="divider">
                Personal Info 
            </div>
            
            <div class="row">
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="firstName" placeholder="First Name" value="{{ $firstName }}" aria-label="first name" readonly />
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-user-o"></i>
                        </span>
                        <input type="text" class="form-control"  name="lastName" placeholder="Last Name" value="{{ $lastName }}" aria-label="last name"  />
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->

            </div><!-- /.row -->
            
            
            <div class="row">
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope"></i>
                        </span>
                        <input type="text" class="form-control" name="primaryEmail" placeholder="Primary Email Address" value="{{ $email }}" aria-label="Primary Email" readonly />
                    </div><!-- /input-group -->
                </div><!-- /.col-lg-6 -->
                
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group {{ $errors->has('AlternateEmail') ?  'has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="fa fa-envelope-o"></i>
                        </span>
                        <input type="email" class="form-control"  name="AlternateEmail" placeholder="Alternate Email Address"  value="{{ old('AlternateEmail') }}" aria-label="Alternate Email " />
                    </div><!-- /input-group -->
                    @if($errors->has('AlternateEmail'))
                        <span class="help-block">
                            <strong>{{ $errors->first('AlternateEmail') }}</strong>
                        </span>
                    @endif 
                </div><!-- /.col-lg-6 -->

            </div><!-- /.row -->
            
            
            <div class="row">
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group {{ $errors->has('PrimaryMobileNumber') ?  'has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="fa fa-phone-square"></i>
                        </span>
                        <input type="text" class="form-control" name="PrimaryMobileNumber" placeholder="Primary Mobile Number" value="{{ old('PrimaryMobileNumber') }}" aria-label="primary Mobile Number"  />                       
                    </div><!-- /input-group -->
                    @if($errors->has('PrimaryMobileNumber'))
                        <span class="help-block">
                            <strong>{{ $errors->first('PrimaryMobileNumber') }}</strong>
                        </span>
                    @endif 
                </div><!-- /.col-lg-6 -->
                
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group {{ $errors->has('AlternateMobileNumber') ?  'has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </span>
                        <input type="text" class="form-control"  name="AlternateMobileNumber" placeholder="Alternate Mobile Number"  aria-label="Alternate Mobile Number" value="{{ old('AlternateMobileNumber')}}"/>
                    </div><!-- /input-group -->
                    @if($errors->has('AlternateMobileNumber'))
                        <span class="help-block">
                            <strong>{{ $errors->first('AlternateMobileNumber') }}</strong>
                        </span>
                    @endif 
                </div><!-- /.col-lg-6 -->

            </div><!-- /.row -->
            
            <div class="divider">
                Delivery Adress 
            </div>
            
            <div class="row">
                <div class="col-lg-12 in-gp-tl">
                <div class="input-group {{ $errors->has('CompleteAddress') ?  'has-error' : '' }}">
                    <span class="input-group-addon" id="basic-addon1"><i class="fa fa-home"></i></span>
                    <textarea type="text" class="form-control" name="CompleteAddress" placeholder="Complete Address with Landmark" aria-describedby="Complete Address" style="resize:none;" >{{ old('CompleteAddress') }}</textarea>
                </div>
                @if($errors->has('CompleteAddress'))
                    <span class="help-block">
                        <strong>{{ $errors->first('CompleteAddress') }}</strong>
                    </span>
                @endif 
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group {{ $errors->has('StreetNumber') ?  'has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="fa fa-road"></i>
                        </span>
                        <input type="text" class="form-control" name="StreetNumber" placeholder="Street Number" aria-label="Street" value="{{ old('StreetNumber') }}" />
                    </div><!-- /input-group -->
                @if($errors->has('StreetNumber'))
                    <span class="help-block">
                        <strong>{{ $errors->first('StreetNumber') }}</strong>
                    </span>
                @endif 
                </div><!-- /.col-lg-6 -->
                
                <div class="col-lg-6 in-gp-tl">
                    <div class="input-group {{ $errors->has('pinCode') ?  'has-error' : '' }}">
                        <span class="input-group-addon">
                            <i class="fa fa-map-marker"></i>
                        </span>
                        <input type="text" class="form-control"  name="pinCode" placeholder="Area Pin Code"  aria-label="Area Pin Code" value="{{ old('pinCode') }}" />
                    </div><!-- /input-group -->
                    @if($errors->has('pinCode'))
                        <span class="help-block">
                            <strong>{{ $errors->first('pinCode') }}</strong>
                        </span>
                    @endif 
                </div><!-- /.col-lg-6 -->

            </div><!-- /.row -->
            
            
            <div class="form-group  {{ $errors->has('CityAndCountry') ?  'has-error' : '' }}">
                <input class="placepicker form-control" name="CityAndCountry" placeholder="Enter City, Country" data-map-container-id="collapseOne" value="{{ old('CityAndCountry') }}" />
                @if($errors->has('CityAndCountry'))
                    <span class="help-block">
                        <strong>{{ $errors->first('CityAndCountry') }}</strong>
                    </span>
                @endif 
            </div>
            
            <div class="form-group">
                <button class="btn btn-success" type="submit" style="padding:5px 40px;font-size:16px;"> Submit </button>
            </div>
            
            </form>
        </div>
    </div>
        
</div>


@endsection


@section('page-specific-js')
<!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
<script src="{{ url('guest/js/jquery.placepicker.js') }}"></script>

<script>
    $(".placepicker").placepicker();
</script>

@endsection