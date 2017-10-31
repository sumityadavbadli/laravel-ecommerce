<div class="header">

    <div class="container">

        <div class="logo">
            <h1><a href="{{ route('home') }}"><b>U<br>W<br>E</b>India Store<span>THE BEST SUPERMARKET</span></a></h1>
        </div>
        <div class="head-t">
            <ul class="card">

                
                @if (Auth::guest())
                <li><a href="{{ url('pending-orders') }}"><i class="fa fa-heart" aria-hidden="true"></i>Pending Orders</a></li>
                <li><a href="{{ url('customer/login') }}"><i class="fa fa-user" aria-hidden="true"></i>Login</a></li>
                <li><a href="{{ url('customer/register') }}"><i class="fa fa-arrow-right" aria-hidden="true"></i>Register</a></li>

                @else
                <li><a href="{{ url('customer/pending-orders') }}"><i class="fa fa-heart" aria-hidden="true"></i>Pending Orders</a></li>
                <li><a href="about.html"><i class="fa fa-file-text-o" aria-hidden="true"></i>Order History</a></li>
                <li><a href="shipping.html"><i class="fa fa-ship" aria-hidden="true"></i>Shipping</a></li>
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"> </i> {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ url('customer/home') }}">Dashboard</a></li>
                        <li>
                            <a href="{{ url('customer/logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                            <form id="logout-form" action="{{ url('customer/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </div>

        <!--
			<div class="header-ri">
				<ul class="social-top">
					<li><a href="#" class="icon facebook"><i class="fa fa-facebook" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon twitter"><i class="fa fa-twitter" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i><span></span></a></li>
					<li><a href="#" class="icon dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i><span></span></a></li>
				</ul>	
			</div>
-->

        
            <div class="form-group">
                <form type="post" action="{{ url('search') }}" role="form">
                     {{ csrf_field() }}
                <div class="input-group input-group-md">
                    <div class="icon-addon addon-md">
                        <input type="text" name="q" placeholder="What are you looking for?" class="form-control searchBar" autocomplete="off">
                    </div>
                    <span class="input-group-btn">
                        <button class="btn btn-warning searchButton"  type="submit"><i class="fa fa-search"></i> Search</button>
                    </span>
                </div>
                </form>
            </div>
        



        <div class="nav-top">
            <nav class="navbar navbar-default">

                <div class="navbar-header nav_2">
                    <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>


                </div>




                <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                    <ul class="nav navbar-nav ">
                        <li><a href="{{ route('home') }}" class="hyper "><span>Home</span></a></li>
                        @foreach($menu as $my)

                        <!--                            <li><a href="#" class="hyper"> <span></span></a></li>-->

                        <li class="dropdown ">
                            <a href="#" class="dropdown-toggle  hyper" data-toggle="dropdown"><span>{{ $my->name }}<b class="caret"></b></span></a> @foreach($child as $ch) @if($ch->parentId==$my->id)
                            <ul class="dropdown-menu multi">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <ul class="multi-column-dropdown">

                                            @foreach($child as $cy) @if($cy->parentId==$my->id)
                                            <?php $secret = Crypt::encrypt($cy->id); ?>
                                                <li><a href="{{ url('products-in') }}/{{ $secret }}"><i class="fa fa-angle-right" aria-hidden="true"></i>{{ $cy->name }}</a></li>
                                                @endif @endforeach

                                        </ul>

                                    </div>

                                    <div class="clearfix"></div>
                                </div>
                            </ul>
                            @endif @endforeach
                        </li>

                        @endforeach
                        <li><a href="contact.html" class="hyper"><span>Contact Us</span></a></li>
                    </ul>
                </div>

            </nav>

            
        <div  style="float: right; cursor: pointer;">
        <span class="fa fa-shopping-cart my-cart-icon"><span class="badge badge-notify my-cart-badge"></span></span>
      </div>
            
            <div class="clearfix"></div>
        </div>

    </div>
</div>