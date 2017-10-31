@extends('layouts.homeMaster')

@section('title','checkout')

@section('body')



<div class="banner-top">
	<div class="container">
        <h3>CheckOut </h3><div id="msg" style="color: #fff;"></div>
        <h4><a href="{{ route('home') }}">Home</a><label>/</label>Checkout</h4>
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
<div class="container">
  <div class="order" style="border:2px solid #606060;padding:20px;margin-top:130px;margin-bottom:150px">
      <span style="font-size:17px;font-family:inherit;display:inline;" >{{Session::get('error')}}</span>
  </div>
</div>
@elseif(Session::has('empty')) 
<div class="container">
  <div class="order" style="border:2px solid #606060;padding:20px;margin-top:130px;margin-bottom:150px">
      <span style="font-size:17px;font-family:inherit;display:inline;" >{{Session::get('empty')}}</span>
  </div>
</div>

@else

@if (Auth::guest())
    <div class="container" id="checkLogin">
  <div class="order" style="border:2px solid #606060;padding:20px;margin-top:10px;margin-bottom:-20px">
      <span style="font-size:17px;font-family:inherit;display:inline;" >To continue your purchase, Please login or register with us !</span>
      <div class="pull-right">
      <span style="display:inline;" ><a href="{{ url('customer/login') }}" class="btn btn-success">Login</a></span>
      <span style="display:inline;" ><a href="{{ url('customer/register') }}" class="btn btn-primary">Register</a></span>
      </div>
  </div>
</div>
@endif


<div class="container" id="empty-error">
  <div class="error-inner" >
      <span>Hello ! You don't have any Pending Orders.</span>
  </div>
</div>


    <div class="check-out">	
        <div class="ajax-loader">
            <img src="{{ url('guest/images/spin.gif') }}" class="img-responsive" />
        </div>
    <div class="container">	 
<!--
        <div class="spec ">
				<h3>Order</h3>
					<div class="ser-t">
						<b></b>
						<span><i></i></span>
						<b class="line"></b>
					</div>
			</div>
-->

        <table class="table ">

            
		  <tr>
			<th class="t-head head-it ">Products</th>
			<th class="t-head">Price</th>
		    <th class="t-head">Quantity</th>
			<th class="t-head">Amount</th>
			<th class="t-head">Action</th>
		  </tr>
		  @foreach($data as $key=>$dd)
        
        <tr id="{{ $dd->productId}}row" class="cross">
            	<td class="ring-in t-data">
				<a href="single.html" class="at-in">
					<img src="{{ url($dd->productImage) }}" class="img-responsive" width="100px" height="100px" alt="{{ $dd->productName }}">
				</a>
			<div class="sed">
				<h5>{{ $dd->productName }}</h5>
			</div>
				<div class="clearfix"> </div>
				
			 </td>
        <td class="t-data">₹ {{$dd->productPrice}}</td>
			<td class="t-data">
                <div class="quantity"> 
                <div class="quantity-select">            
				    <div class="entry value-minus" onclick="myMinusFunction('{{ $dd->productId }}','{{ $dd->productQuantity }}','{{ $dd->productPrice }}')" >&nbsp;</div>
					
                    <div id="{{ $dd->productId}}value" class="entry value">{{ $dd->productQuantity }}</div>		
                    
                    <div class="entry value-plus active" onclick="myPlusFunction('{{ $dd->productId }}','{{ $dd->productQuantity }}','{{ $dd->productPrice }}')">&nbsp;</div>	
				</div>
				</div>
			
			</td>

			<td class="t-data t-w3l" id="{{ $dd->productId}}amount" >₹ {{ $dd->productPrice*$dd->productQuantity }}</td>
            <td class="t-data"><button class="btn btn-danger" style="outline:none;" onclick="myDeleteFunction('{{ $dd->productId }}')" ><i class="fa fa-times" aria-hidden="true"></i></button></td>
			
		  </tr>
        @endforeach		  
        
        <tr>
            <td class="t-foot"></td>
            <td class="t-foot"></td>
            <td class="t-foot"><b>Total Items :</b></td>
            <td class="t-foot"><p id="totalUnits">{{ $quantity }}</p></td>
            <td class="t-foot"></td>
		</tr>
     
        <tr>
            <td class="t-foot"></td>
            <td class="t-foot"></td>
            <td class="t-foot"><b>Total Amount :</b></td>
            <td class="t-foot"><p id="totalAmount" >₹ {{ $price }}</p></td>
            <td class="t-foot"></td>
		</tr>
     
	</table>
        
	</div>
</div>
@endif






@endsection 

@section('page-specific-js')
<script type='text/javascript' src="{{ url('guest/js/myAjax.js') }}"></script>
@endsection