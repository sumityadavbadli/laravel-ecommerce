<nav class="top-bar animate-dropdown">
            <div class="container">
                <div class="col-xs-12 col-sm-6 no-margin">
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="contact.html">Contact</a></li>
                    </ul>
                </div>
                <!-- /.col -->

                <div class="col-xs-12 col-sm-6 no-margin">
                    
                    <ul class="right">
                    @if (Auth::guest())
                        <li><a href="{{ url('seller/register') }}">Register</a></li>
                        <li><a href="{{ url('seller/login') }}">Login</a></li>
                    @else
                            <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/seller/home') }}">Dashboard</a></li>
                                <li>
                                    <a href="{{ url('/logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

                        
                    </ul>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.container -->
</nav>