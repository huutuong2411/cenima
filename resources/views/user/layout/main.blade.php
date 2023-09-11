<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title')</title>
    <!-- Favicon Icon -->
    <!-- Latest compiled and minified CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
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
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/ticket.css')}}" media="all"/>
    <!-- Responsive CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('user/assets/css/responsive.css')}}" media="all" />


    <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <link href="{{asset('admin/assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://www.jqueryscript.net/demo/Simple-Flexible-jQuery-Alert-Notification-Plugin-notify-js/css/notify.css">

    <script type="text/javascript">
        $(document).ready(function() {
            var success = "{{session('success')}}"
            var error = "{{session('error')}}"
            var deleted = "{{session('delete')}}"
            if (success) {
                $.notify(success, {
                    color: "#fff",
                    background: "#20D67B"
                });
            }

            if (error) {
                $.notify(error, {
                    color: "#fff",
                    background: "#D44950"
                });
            }

            if (deleted) {
                $.notify(deleted, {
                    color: "#fff",
                    background: "#A5881B"
                });
            }
        });
    </script>
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
                <form action="{{route('user.create_order')}}" method="post">
                    @csrf
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="buy-ticket-box">
                                <h4>Mua vé</h4>
                                <h5>Sơ đồ ghế</h5>
                                <h6 class="mx-auto">Màn hình</h6>
                                <div class="ticket-box-table">
                                    <table>
                                        <tbody id="row_showtime">
                                        </tbody>
                                    </table>
                                    <table class="ticket-table-seat mx-auto">
                                        <tbody id="column_showtime">

                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <label class="btn btn-danger">ghế bạn chọn</label>
                                <label class="btn btn-secondary">ghế đã đặt</label>
                                <label class="btn btn-outline-dark">ghế trống</label>
                            </div>
                        </div>
                        <div class="col-lg-3 offset-lg-1">
                            <div class="buy-ticket-box mtr-30" id="infor">
                                <h4>Thông tin vé</h4>
                                <input type="hidden" id="showtimeID" name="showtimeID" value="">
                                <ul>
                                    <li>
                                        <p>Rạp chiếu</p>
                                        <span class="text-primary" id="theater_name">CGV Đà Nẵng</span>
                                        <br>
                                        <span id="theater_address">30 Huy Du Đà Nẵng</span>
                                    </li>
                                    <li>
                                        <p>Thời gian</p>
                                        <span class="text-danger" id="time_start">20:40</span>
                                        <br>
                                        <span id="showtime_date">Ngày 23/08/2023</span>
                                    </li>
                                    <li>
                                        <p>Tên phim</p>
                                        <span id="movie_name">Bộ đôi báo thử</span>
                                    </li>
                                    <li>
                                        <p>Số ghế</p>
                                        <span id="seat_number">

                                        </span> <br>
                                        <span id="room_theater"></span>
                                    </li>
                                    <li>
                                        <p>Giá</p>
                                        <span id="total_price">0đ</span>
                                    </li>
                                </ul>
                            </div>
                        </div>


                    </div>
                    <button type="submit" class="theme-btn col-2 text-center">Đặt vé</button>
                </form>
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
    <script src="https://www.jqueryscript.net/demo/Simple-Flexible-jQuery-Alert-Notification-Plugin-notify-js/js/notify.js"></script>
</body>

</html>