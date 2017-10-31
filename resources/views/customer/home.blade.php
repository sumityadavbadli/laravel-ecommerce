
@extends('layouts.homeMaster')

@section('title','Your Account')

@section('body')
<!-- banner-top -->
<div class="banner-top">
	<div class="container">
		<h3 >Your Account</h3>
<!--		<h4><a href="{{ route('home') }}">Home</a><label>/</label>Login</h4>-->
		<div class="clearfix"> </div>
	</div>
</div>

@if(Session::has('message'))
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Success!</strong> {{ Session::get('message') }}
	</div>
@endif

@if(Session::has('error'))
	<div class="alert alert-danger alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong>Error!</strong> {{ Session::get('error') }}
	</div>
@endif
<div class="container-fluid">
    
    <div class="container">
        <div class="row account-rows">
            <div class="col-sm-4 inner-row">
                <sub-head>Orders</sub-head>
                <p>See &amp; Modify Recent Orders</p>
            </div>
            
            <div class="col-sm-4 inner-row">
                <sub-child>Track Your Orders</sub-child>
                <button class="btn btn-warning" style="width:150px;">Your Orders &gt;</button>
                
                
            </div>
            
            <div class="col-sm-4 inner-row">
                <sub-child>Order History</sub-child>
                
             	<ul class="list-group">
		          <li class="list-group-item"><a href="#">View Open Orders </a></li>
		          <li class="list-group-item"><a href="#">View Cancelled Orders </a></li>
		          <li class="list-group-item"><a href="{{ url('customer/pending-orders') }}">View Pending Orders </a></li>

		      </ul>

                
            </div>
        </div>
        
    
        <div class="row account-rows">
            <div class="col-sm-4 inner-row">
                <sub-head>Settings</sub-head>
                <p>Edit your Profile</p>
            </div>
            
            <div class="col-sm-4 inner-row">
                <sub-child>Personal Details</sub-child>
             	<ul class="list-group">
		          <li class="list-group-item"><a href="#">Edit Personal Info</a></li>
		          <li class="list-group-item"><a href="#">Edit Delevery Details</a></li>
		          <li class="list-group-item"><a href="{{ url('customer/complete-your-profile') }}">User Profile</a></li>
		      </ul>           
            </div>
            
            <div class="col-sm-4 inner-row">
                <sub-child>Account Details</sub-child>   
             	<ul class="list-group">
		          <li class="list-group-item"><a href="#">Reset Email Address </a></li>
		          <li class="list-group-item"><a href="#">Reset Account Password</a></li>
		      </ul>    
            </div>
        </div>
        
    </div>
        
</div>
@endsection
