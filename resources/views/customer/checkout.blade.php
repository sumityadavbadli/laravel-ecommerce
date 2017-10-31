@extends('layouts.homeMaster')

@section('title','checkout')

@section('body')



<div class="banner-top">
	<div class="container">
        <h3>CheckOut </h3>
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
  <div class="typrography">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <strong>Error!</strong> {{ Session::get('error') }}
    </div>
  </div>
</div>
@elseif(Session::has('empty')) 
<div class="container">
  <div class="order" style="border:2px solid #606060;padding:20px;margin-top:130px;margin-bottom:150px">
      <span style="font-size:17px;font-family:inherit;display:inline;" >{{Session::get('empty')}}</span>
  </div>
</div>
@else


@if(!Auth::user()->status)
    <div id="authStatus" class="container">
  <div class="order" style="border:2px solid #606060;padding:20px;margin-top:10px;margin-bottom:-20px">
      <span style="font-size:17px;font-family:inherit;display:inline;" >To continue your purchase, Please complete your profile with Address Details !</span>
      <div class="pull-right">
        <a class="btn btn-primary" href="{{ url('customer/complete-your-profile') }}">Edit Profile</a>
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

            
<!--             $data is an individual order -->
<!--            $demo is child order items -->
        <?php    static $key=0; ?>
		  @foreach($data as $dd)
    
        <tr  id="{{ $dd->productId}}row" class="cross">
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
				    <div class="entry value-minus" onclick="userMinusFunction('{{ $dd->productId }}','{{ $dd->productQuantity }}','{{ $dd->productPrice }}')" >&nbsp;</div>
					
                    <div id="{{ $dd->productId}}value" class="entry value">{{ $dd->productQuantity }}</div>		
                    
                    <div class="entry value-plus active" onclick="userPlusFunction('{{ $dd->productId }}','{{ $dd->productQuantity }}','{{ $dd->productPrice }}')">&nbsp;</div>	
				</div>
				</div>
			
			</td>

			<td class="t-data t-w3l" id="{{ $dd->productId}}amount" >₹ {{ $dd->productPrice*$dd->productQuantity }}</td>
			<td class="t-data"><button class="btn btn-danger" style="outline:none;" onclick="userDeleteFunction('{{ $dd->productId }}')" ><i class="fa fa-times" aria-hidden="true"></i></button></td>
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

@if(Auth::user()->status)
    <div class="address-box" id="addressBox">
        
    <div class="container"> 
        <div id="border-box">
            <div class="text-center" style="font-size:18px;padding:8px;border-bottom:1px solid #eee;box-shadow: 0px 0px 8px rgba(0,0,0,0.1);"><b>Delivery Details</b></div>            
        <b>Name : </b>{{ $customer->firstName }} {{ $customer->lastName }}
        <br/>
        <br/>
        <b>Email Id :</b> {{ $customer->email }}
        <br/>
        <br/>
        <b>Mobile No. :</b> {{ $customer->contact }}
        <br/>
        <br/>
        <b>Address :</b> {{ $customer->address }} , Street- {{ $customer->street }} , {{ $customer->location }}
        <br/>
        <br/>
        <b>Pin Code:</b> {{ $customer->pinCode }}
        </div>
        </div>
    
    </div>

    <div style="margin-top:20px;margin-bottom:50px;" >
<div class="container" id="submitBox">
    <button class="btn btn-primary btn-lg pull-right"> Confirm Order &gt;&gt;</button>
</div>
</div>
@endif


@endif   
<!--end of error else-->






@endsection 

@section('page-specific-js')
<script type='text/javascript' src="{{ url('guest/js/myAjax.js') }}"></script>
@endsection