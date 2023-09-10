<header class="header">
    <div class="container">
        <div class="header-area">
            <div class="logo">
                <a href="index-2.html"><img src="{{asset('user/assets/img/logo.png')}}" alt="logo" /></a>
            </div>
            <div class="header-right">
                <form action="#">
                    <select>
                        <option value="Movies">Movies</option>
                        <option value="Movies">Movies</option>
                        <option value="Movies">Movies</option>
                    </select>
                    <input type="text" />
                    <button><i class="icofont icofont-search"></i></button>
                </form>
                <ul>
                    @if(!Auth::check())
                    <li><a href="#">[Khách!]</a></li>
                    <li><a class="" href="{{route('user.login')}}">Login</a></li>
                    @else
                    <li><a href="#">{{Auth::user()->name}}</a></li>
                    <li><a class="" href="{{route('user.login')}}">LogOut</a></li>
                    @endif
                </ul>
            </div>
            <div class="menu-area">
                <div class="responsive-menu"></div>
                <div class="mainmenu">
                    <ul id="primary-menu">
                        <li><a class="active" href="index-2.html">Home</a></li>
                        <li><a href="#">Lịch chiếu <i class="icofont icofont-simple-down"></i></a>
                            <ul>
                                <li><a href="blog-details.html">Đang chiếu</a></li>
                                <li><a href="movie-details.html">Sắp chiếu</a></li>
                            </ul>
                        </li>
                        <li><a href="celebrities.html">Review phim</a></li>
                        <li><a href="#">Rạp chiếu <i class="icofont icofont-simple-down"></i></a>
                            <ul>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="movie-details.html">Movie Details</a></li>
                            </ul>
                        </li>
                        <li><a href="blog.html">News</a></li>
                        <li><a class="theme-btn" href="#"><i class="icofont icofont-ticket"></i> Vé của bạn</a></li>
                        <button type="button" id="testclick">test click</button>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>