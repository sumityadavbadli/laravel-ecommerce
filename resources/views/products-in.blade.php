@extends('layouts.homeMaster')

@section('title','Home')

@section('body')
@if(Session::has('blankRequest'))

<div class="banner-top">
	<div class="container">
		<h3 >Page Not Found !</h3>
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
     

@else
<div class="banner-top">
	<div class="container">
		<h3 >{{ $parentName }}</h3>
        <h4><a href="{{ route('home') }}">Home</a><label>/</label><a href="/search?q={{$parentName}}">{{$parentName}}</a><label>/</label>{{ $pageName }}</h4>
		<div class="clearfix"> </div>
	</div>
</div>
	
  <!-- Carousel
    ================================================== -->
<!--
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
       Indicators 
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner" role="listbox">
        <div class="item active">
         <a href="kitchen.html"> <img class="first-slide" src="{{ url('guest/images/ba.jpg') }}" alt="First slide"></a>
       
        </div>
        <div class="item">
         <a href="care.html"> <img class="second-slide " src="{{ url('guest/images/ba1.jpg') }}" alt="Second slide"></a>
         
        </div>
        <div class="item">
          <a href="hold.html"><img class="third-slide " src="{{ url('guest/images/ba2.jpg') }}" alt="Third slide"></a>
          
        </div>
      </div>
    
    </div>
-->
  <!-- /.carousel -->


    <!--content-->
		<div class="product">
		<div class="container">
			<div class="spec ">
				<h3>{{ $pageName }}</h3>
				<div class="ser-t">
					<b></b>
					<span><i></i></span>
					<b class="line"></b>
				</div>
			</div>
				<div class=" con-w3l agileinf">
							@foreach($productList as $pl)
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

<div class="text-center" style="padding-top:10px 0px 10px 0px;">
{{ $productList->links() }}
</div>
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