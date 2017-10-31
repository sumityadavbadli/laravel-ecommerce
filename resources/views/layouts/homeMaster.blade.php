<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <script type="application/x-javascript"> 
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0); 
        }, false);
        function hideURLbar(){
            window.scrollTo(0,1);
        } 
    </script>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ url('guest/css/bootstrap.css') }}">
    
    

    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ url('guest/css/style.css') }}">
    
    <!-- js -->
    <script src="{{ url('guest/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ url('guest/js/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ url('guest/js/jquery-3.1.1.min.js') }}"></script>
    <!-- //js -->

    
    
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{ url('guest/js/move-top.js') }} "></script>
    <script type="text/javascript" src="{{ url('guest/js/easing.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){		
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	   });
    </script>

    <!-- Fonts -->
    <!-- start-smoth-scrolling -->
    <link href="{{ url('guest/css/font-awesome.min.css') }}" rel="stylesheet"> 
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet'  type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>

    <!--- start-rate---->
    <script src="{{ url('guest/js/jstarbox.js') }}"></script>
	<link rel="stylesheet" href="{{ url('guest/css/jstarbox.css') }}" type="text/css" media="screen" charset="utf-8" />
		<script type="text/javascript">
			jQuery(function() {
			jQuery('.starbox').each(function() {
				var starbox = jQuery(this);
					starbox.starbox({
					average: starbox.attr('data-start-value'),
					changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
					ghosting: starbox.hasClass('ghosting'),
					autoUpdateAverage: starbox.hasClass('autoupdate'),
					buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
					stars: starbox.attr('data-star-count') || 5
					}).bind('starbox-value-changed', function(event, value) {
					if(starbox.hasClass('random')) {
					var val = Math.random();
					starbox.next().text(' '+val);
					return val;
					} 
				})
			});
		});
        </script>
    <!---//End-rate---->
    
    @yield('page-specific-css')
    
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('images/favicon.ico') }}">

    <!-- HTML5 elements and media queries Support for IE8 : HTML5 shim and Respond.js -->
    <!--[if lt IE 9]>
			<script src="assets/js/html5shiv.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->


</head>

<body>
<!--    <a href="#"><img src="{{ url('guest/images/download.png') }}" class="img-head" alt=""></a>-->
    <div class="wrapper">


        
        @include('includes.homeHeader')
        
        @yield('body')
        
        @include('includes.homeFooter')

    </div>
   


    
<!-- Some Common Javacscript files below -->
    <!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
			};
										
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!-- //smooth scrolling -->
<!-- for bootstrap working -->
		<script src="{{ url('guest/js/bootstrap.js') }}"></script>
    
<!--    for autocomplete -->
    <link rel="stylesheet" href="{{ url('guest/css/jquery-ui.css') }}">
    <script src="{{ url('guest/js/jquery-ui.js') }}"></script>
    
<!--		end here-->
    
<!-- //for bootstrap working -->
<script type='text/javascript' src="{{ url('guest/js/jquery.mycart.js') }}"></script>
  <script type="text/javascript">
  $(function () {

    var goToCartIcon = function($addTocartBtn){
      var $cartIcon = $(".my-cart-icon");
      var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "fixed", "z-index": "999"});
      $addTocartBtn.prepend($image);
      var position = $cartIcon.position();
      $image.animate({
        top: position.top,
        left: position.left
      }, 500 , "linear", function() {
        $image.remove();
      });
    }
 
  $('.my-cart-btn').myCart({
      classCartIcon: 'my-cart-icon',
      classCartBadge: 'my-cart-badge',
      classProductQuantity: 'my-product-quantity',
      classProductRemove: 'my-product-remove',
      classCheckoutCart: 'my-cart-checkout',
      affixCartIcon: true,
      showCheckoutModal: true,
//    checkoutCart: function(products) {
//      $.each(products, function(){
//          kart = console.log(this);
//      });
//
//    },
    clickOnAddToCart: function($addTocart){
      goToCartIcon($addTocart);
    },
      clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
        console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
      },
      checkoutCart: function(products, totalPrice, totalQuantity) {
//        var arr = Object.keys(products).map(function (key) { return products[key]; });
        var fifi=  JSON.stringify(products);
        postAndRedirect('/checkout', fifi,totalPrice,totalQuantity);
        console.log("checking out", products, totalPrice, totalQuantity);
      },
    getDiscountPrice: function(products) {
      var total = 0;
      $.each(products, function(){
        total += this.quantity * this.price;
      });
      return total * 1;
    }
  });

});
      
 function postAndRedirect(url, postpro,postpri,postqua)
{
    var postFormStr = "<form method='POST' action='" + url + "'>\n";
    postFormStr += "<input type='hidden' name='_token' value='{{ csrf_token()}}'>";
    postFormStr += "<input type='hidden' name='products' value='" + postpro + "'></input>";
    postFormStr += "<input type='hidden' name='price' value='" + postpri + "'></input>";
    postFormStr += "<input type='hidden' name='quantity' value='" + postqua + "'></input>";
    postFormStr += "</form>";

    var formElement = $(postFormStr);

    $('body').append(formElement);
    $(formElement).submit();
}
  </script>   
@yield('page-specific-js')
    
        <script>
        $(document).ready(function(){
           window.setTimeout(function() {
            $(".my-drop-down").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
            });
           }, 3000);        
        });
    </script>
    
    
    <script>
    $(document).ready(function(){
	$(".searchBar").on('focus',function(){
		$.ajax({
		type: "GET",
		url: "/get-search-data",
//		data:'text='+$(this).val(),
//		beforeSend: function(){
//			$(".search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
//		},
		success: function(data){
//			$("#suggesstion-box").show();
//			$("#suggesstion-box").html(data);
//			$("#search-box").css("background","#FFF");
            var availableTags = data.items;     
            $( ".searchBar" ).autocomplete({
                source: availableTags
            });
            console.log(data.items);
		}
		});
	});
});    
        
        
        
//  $( function() {
//    var availableTags = [
//      "ActionScript",
//      "AppleScript",
//      "Asp",
//      "BASIC",
//      "C",
//      "C++",
//      "Clojure",
//      "COBOL",
//      "ColdFusion",
//      "Erlang",
//      "Fortran",
//      "Groovy",
//      "Haskell",
//      "Java",
//      "JavaScript",
//      "Lisp",
//      "Perl",
//      "PHP",
//      "Python",
//      "Ruby",
//      "Scala",
//      "Scheme"
//    ];
//    $( ".searchBar" ).autocomplete({
//      source: availableTags
//    });
//  } );
  </script>
    
</body>

</html>