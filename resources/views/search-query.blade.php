@extends('layouts.homeMaster')

@section('title','Home')

@section('body')
@if(Session::has('blankRequest'))

<div class="banner-top">
	<div class="container">
		<h3 >Error !</h3>
		<h4>Please Try <a href="{{ route('home') }}"> Home</a> Page</h4>
		<div class="clearfix"> </div>
	</div>
</div>
 
<div class="product">
<div class="container">
    <div class="spec ">
    <span class="fa fa-close" style="color:#ED0612; font-size:80px;"></span>
        <br/>
	<h3>{{ Session::get('blankRequest') }}</h3>
	<div class="ser-t">
		<b></b>
		<span><i></i></span>
		<b class="line"></b>
	</div>
	</div>
</div>
</div>
     
@elseif(Session::has('noResultFound'))

<div class="banner-top">
	<div class="container">
		<h3 >Searched for : {{ $keyword }}</h3>
		<h4>Please Try <a href="{{ route('home') }}"> Home</a> Page</h4>
		<div class="clearfix"> </div>
	</div>
</div>
 
<div class="product">
<div class="container">
    <div class="spec ">
    <span class="fa fa-close" style="color:#ED0612; font-size:80px;"></span>
        <br/>
	<h3>{{ Session::get('noResultFound') }}</h3>
	<div class="ser-t">
		<b></b>
		<span><i></i></span>
		<b class="line"></b>
	</div>
	</div>
</div>
</div>
 
@else
<div class="banner-top">
	<div class="container">
        <h3>Search Results: {{ $keyword }}</h3>
        <h4><a href="{{ route('home') }}">Home</a><label>/</label>Search</h4>
		<div class="clearfix"> </div>
	</div>
</div>
	



    <!--content-->
		<div class="product">
		<div class="container">
				<div class=" con-w3l agileinf">
							@foreach($items as $pl)
                            <div class="col-md-3 pro-1">
								<div class="col-m">
                                   
								<a href="#" class="offer-img">
                                    <?php $address=substr($pl->productImage,42); ?>
										<img src="{{ url($address) }}" class="img-responsive" alt="">
									</a>
									<div class="mid-1">
										<div class="women">
                                            @if($pl->productWeight==0)
                                            <h6><a href="{{ url('product-view') }}/{{ $pl->productId }}">{{ $pl->productName }}</a></h6>					
                                            @else
											<h6><a href="{{ url('product-view') }}/{{ $pl->productId }}">{{ $pl->productName }}</a> ({{ $pl->productWeight }} kg)</h6>					@endif		
										</div>
											<div class="mid-2">
                                            <p ><label><i class="fa fa-inr"></i>{{ $pl->regularPrice}}</label><em class="item_price"><i class="fa fa-inr"></i>{{ $pl->salePrice }}</em></p>
											  <div class="block">
                                                  <div class="small ghosting" style="font-size:14px;"> <b>{{ $pl->status==1 ? 'In Stock' : 'Out Of Stock'}}</b></div>
											</div>
											<div class="clearfix"></div>
										</div>
								        <div class="add add-2">
										   <button class="btn btn-danger my-cart-btn my-cart-b" data-id="{{ $pl->productId }}" data-name="{{ $pl->productName }}" data-summary="{{ $pl->shortDescription }}" data-price="{{ $pl->salePrice }}" data-quantity="1" data-image="{{ url($address) }}">Add to Cart</button>
                                            <a href="{{ url('product-view') }}/{{ $pl->productId }}" class="btn btn-danger my-cart-btn my-cart-b">Details</a>

										</div>
									</div>
								</div>
							</div>
							@endforeach
                            <div class="clearfix"></div>
						 </div>
		</div>
	</div>

<!--
<div class="text-center" style="padding-top:10px 0px 10px 0px;">

</div>
-->
      <!--content-->
<!--
<div class="kic-top ">
	<div class="container ">
	<div class="kic ">
			<h3>Popular Categories</h3>
			
		</div>
		<div class="col-md-4 kic-top1">
			<a href="single.html">
				<img src="{{ url('guest/images/ki3.jpg') }}" class="img-responsive" alt="">
			</a>
			<h6>Natural Cream</h6>
			<p>Nam libero tempore</p>
		</div>
		<div class="col-md-4 kic-top1">
			<a href="single.html">
				<img src="{{ url('guest/images/ki4.jpg') }}" class="img-responsive" alt="">
			</a>
			<h6>Shaving Kit</h6>
			<p>Nam libero tempore</p>
		</div>
		<div class="col-md-4 kic-top1">
			<a href="single.html">
				<img src="{{ url('guest/images/ki5.jpg') }}" class="img-responsive" alt="">
			</a>
			<h6>Makeup Kit</h6>
			<p>Nam libero tempore</p>
		</div>
	</div>
</div>
-->

@endif
@endsection 

@section('page-specific-js')
//
@endsection