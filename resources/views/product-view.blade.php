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
@foreach($singleProduct as $sp)
	
 <!--banner-->
<div class="banner-top">
	<div class="container">
		<h3 >{{ $sp->productName }}</h3>
		<h4><a href="{{ route('home') }}">Home</a><label>/</label>{{ $sp->productName }}</h4>
		<div class="clearfix"> </div>
	</div>
</div>

    <div class="single">
			<div class="container">
                <div class="single-top-main">
	   		<div class="col-md-5 single-top">

            <div class="single-w3agile">
                <?php $address=substr($sp->productImage,42); $full=substr($sp->productFullImage,42);?>	
                <div id="picture-frame">
			     <img src="{{ url($address) }}" data-src="{{ url($full) }}" alt="" class="img-responsive"/>
		        </div>
                <script src="{{ url('guest/js/jquery.zoomtoo.js') }}"></script>
				<script>
			         $(function() {
				        $("#picture-frame").zoomToo({
					    magnify: 1
				        });
			         });
		        </script>
            </div>    
                    
			</div>
			<div class="col-md-7 single-top-left ">
				<div class="single-right">
				<h3>{{ $sp->productName }} {{ $sp->modelNumber=="na" ? ' ' : '$sp->modelNumber' }}</h3>
				
                <div style="padding-top:20px;" >
                    <label>Regular Price : </label>
                    <p class="reduced "><del> <i class="fa fa-inr"></i> {{ $sp->regularPrice }}</del></p>
                </div>
                
                <div style="padding-top:20px;">
                    <label>Sale Price : </label>
                    <p class="reduced "> <i class="fa fa-inr"></i> {{ $sp->salePrice }}</p>
                    
                </div>
                    

<!--
				<div class="block block-w3">
					<div class="starbox small ghosting"> </div>
				</div>
-->
                <div class="block block-w3" style="padding-top:20px;">
                    <label>Availabilty : </label> <p style="display:inline;">{{ $sp->status==1 ? 'In Stock' : 'Out Of Stock'}}</p>
				</div>
				<p class="in-pa"> {{ $sp->shortDescription }} </p>
			   	
<!--
				<ul class="social-top">
					<li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>
				</ul>
-->
					<div class="add add-3">
					  <button class="btn btn-danger my-cart-btn my-cart-b" data-id="{{ $sp->productId }}" data-name="{{ $sp->productName }}" data-summary="{{ $sp->shortDescription }}" data-price="{{ $sp->salePrice }}" data-quantity="1" data-image="{{ url($address) }}">Add to Cart</button>
                    </div>
				
				 
			   
			<div class="clearfix"> </div>
			</div>
		 

			</div>
		   <div class="clearfix"> </div>
	   </div>	
				 
				
	</div>
</div>
    <br/>
    <br/>
<div class="container">
    <p style="font-weight:bold;">Product Description :</p>
    <p class="in-pa">{{ $sp->productDescription }}</p>
</div>
<hr/>
<div class="container">
    <p style="font-weight:bold;">Product Specifications :</p>
    <div style="font-size: 12px;margin-top:20px;" >
    <table class="table table-bordered">
        <tr>
            <td><b>Weight:</b></td>
            @if($sp->productWeight=="0")
            <td>Not Applicable</td>
            @else
            <td>{{ $sp->productWeight }} Kg</td>
            @endif
        </tr>
        <tr>
            <td><b>Dimensions:</b></td>
            @if($sp->productLength=="na" || $sp->productBreadth=="na" || $sp->productHeight=="na")
            <td>Not Applicable</td>
            @else
            <td>{{ $sp->productLength }} x {{ $sp->productBreadth }} x {{ $sp->productHeight }} Inch</td>
            @endif
        </tr>
    </table>
    </div>
</div>
@endforeach
@endif
@endsection 

@section('page-specific-js')
//
@endsection