<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title')</title>
    <!-- Favicon Icon -->
    <link rel="icon" type="image/png" href="{{asset('user/assets/img/favcion.png')}}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/bootstrap.min.css')}}" media="all" />
    <!-- Slick nav CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/slicknav.min.css')}}" media="all" />
    <!-- Iconfont CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/icofont.css')}}" media="all" />
    <!-- Owl carousel CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/owl.carousel.css')}}">
    <!-- Popup CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/magnific-popup.css')}}">
    <!-- Main style CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/style.css')}}" media="all" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/responsive.css')}}" media="all" />
    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    
</head>

<body>
    <!-- Page loader -->
    <div id="preloader"></div>
    <!-- header section start -->
    @include('user.layout.header')
    <div class="buy-ticket">
        <div class="container">
            <div class="buy-ticket-area">
                <a href="#"><i class="icofont icofont-close"></i></a>
                <div class="row">
                    <div class="col-lg-8">
                        <div class="buy-ticket-box">
                            <h4>Buy Tickets</h4>
                            <h5>Seat</h5>
                            <h6>Screen</h6>
                            <div class="ticket-box-table">
                                <table class="ticket-table-seat">
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                    </tr>
                                </table>
                                <table class="ticket-table-seat">
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td class="active">1</td>
                                        <td class="active">1</td>
                                        <td class="active">1</td>
                                        <td class="active">1</td>
                                        <td class="active">1</td>
                                        <td class="active">1</td>
                                        <td class="active">1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                                <table>
                                    <tr>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                    </tr>
                                </table>
                                <table class="ticket-table-seat">
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="ticket-box-available">
                                <input type="checkbox" />
                                <span>Available</span>
                                <input type="checkbox" checked />
                                <span>Unavailable</span>
                                <input type="checkbox" />
                                <span>Selected</span>
                            </div>
                            <a href="#" class="theme-btn">previous</a>
                            <a href="#" class="theme-btn">Next</a>
                        </div>
                    </div>
                    <div class="col-lg-3 offset-lg-1">
                        <div class="buy-ticket-box mtr-30">
                            <h4>Your Information</h4>
                            <ul>
                                <li>
                                    <p>Location</p>
                                    <span>HB Cinema Box Corner</span>
                                </li>
                                <li>
                                    <p>TIME</p>
                                    <span>2018.07.09 20:40</span>
                                </li>
                                <li>
                                    <p>Movie name</p>
                                    <span>Home Alone</span>
                                </li>
                                <li>
                                    <p>Ticket number</p>
                                    <span>2 Adults, 2 Children, 2 Seniors</span>
                                </li>
                                <li>
                                    <p>Price</p>
                                    <span>89$</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- header section end -->
    @yield('content')
    <!-- footer section start -->
    @include('user.layout.footer')
    <!-- jquery main JS -->
    <script src="{{asset('user/assets/js/jquery.min.js')}}"></script>
    <!-- Bootstrap JS -->
    <script src="{{asset('user/assets/js/bootstrap.min.js')}}"></script>
    <!-- Slick nav JS -->
    <script src="{{asset('user/assets/js/jquery.slicknav.min.js')}}"></script>
    <!-- owl carousel JS -->
    <script src="{{asset('user/assets/js/owl.carousel.min.js')}}"></script>
    <!-- Popup JS -->
    <script src="{{asset('user/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <!-- Isotope JS -->
    <script src="{{asset('user/assets/js/isotope.pkgd.min.js')}}"></script>
    <!-- main JS -->
    <script src="{{asset('user/assets/js/main.js')}}"></script>
</body>

</html>