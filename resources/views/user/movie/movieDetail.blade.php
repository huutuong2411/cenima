@extends('user.layout.main')
@section('title')
{{$movie->name}}
@endsection
@section('content')
<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1>PHIM - {{$movie->name}}</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- transformers area start -->
<section class="transformers-area">
    <div class="container">
        <div class="transformers-box">
            <div class="row flexbox-center">
                <div class="col-lg-5 text-lg-left text-center">
                    <div class="transformers-content">
                        <img src="{{asset('/admin/assets/img/movies/'.$movie->image)}}" alt="about" />
                        <a href="{{$movie->trailer}}" class="popup-youtube">
                            <i class="icofont icofont-ui-play"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="transformers-content">
                        <h2>{{$movie->name}}</h2>
                        <p></p>
                        <ul>
                            <li>
                                <div class="transformers-left">
                                    Thể loại:
                                </div>
                                <div class="transformers-right">
                                    {{$movie->categories->name}} <button href="" class="theme-btn">{{$movie->age_limit
                                        !=0?$movie->age_limit.'+':'không giới hạn tuổi' }}</button>
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Thời lượng:
                                    </div>
                                    <div class="transformers-right">
                                        {{$movie->time}} phút
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Khởi chiếu:
                                    </div>
                                    <div class="transformers-right">
                                        {{date('d/m/Y', strtotime($movie->start_date))}}
                                    </div>
                                </li>
                                <li>
                                    <div class="transformers-left">
                                        Nội dung:
                                    </div>
                                    <div class="transformers-right">
                                        <p>{!!$movie->description!!}</p>
                                    </div>
                                </li>
                                <li> <a href="#" id="gotocheckout" class="theme-btn" data-bs-toggle="modal" data-target="#exampleModal"><i class="icofont icofont-ticket"></i>Mua vé</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- transformers area end -->
    <!-- details area start -->
    <section class="details-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="details-content">
                        <div class="details-overview ">
                            <h2>Chọn suất chiếu</h2>
                            <div class="buy-ticket-area mt-1 p-2 card mb-4">
                                <div class="card-body">
                                        <div class="mb-3 row">
                                            <div class="col-4">
                                                <label class="text-primary">Chọn thành phố:</label>
                                                <select required="" class="form-select form-control" name="city" id="city">
                                                    <option value="">--Chọn--</option>
                                                    @foreach($city as $value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-3">
                                                <label class="text-primary">Chọn rạp: </label>
                                                <select required="" class="form-select form-control" name="theaters"
                                                id="theaters">
                                                <option value="">--Chọn--</option>

                                            </select>
                                        </div>
                                    </div>
                                    <hr class="primary">
                                    <label class="text-primary">Chọn ngày: </label>
                                    <div class="row" id="date">
                                    </div>
                                    
                                    <hr class="primary">
                                    <label class="text-primary">Suất chiếu: </label>
                                        <div class="card-body row pt-0" id="showtimes">
                                        </div>
                                   
                            </div>
                        </div>

                    </div>
                    <div class="details-reply">
                                <h2>Leave a Reply</h2>
                                <form action="#">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="select-container">
                                                <input type="text" placeholder="Name"/>
                                                <i class="icofont icofont-ui-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="select-container">
                                                <input type="text" placeholder="Email"/>
                                                <i class="icofont icofont-envelope"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="select-container">
                                                <input type="text" placeholder="Phone"/>
                                                <i class="icofont icofont-phone"></i>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="textarea-container">
                                                <textarea placeholder="Type Here Message"></textarea>
                                                <button><i class="icofont icofont-send-mail"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    <div class="details-comment">
                        <a class="theme-btn theme-btn2" href="#">Post Comment</a>
                        <p>You may use these HTML tags and attributes: You may use these HTML tags and attributes: You
                        may use these HTML tags and attributes: </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- modal bắt đăng nhập -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 76px!important;min-width: 461px!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-danger" id="exampleModalLabel">Thông báo</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Bạn cần đăng nhập trước khi đặt vé
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        <a href="{{route('user.login')}}" class="btn btn-warning">Đăng nhập</a>
        
      </div>
    </div>
  </div>
</div>
<!-- đóng modal bắt đăng nhập -->
<!-- Jquery -->
<script type="text/javascript">
    $('.details-overview').hide();
   $(document).ready(function() { 
    $('#city').change(function() {
            var id_city = $(this).val();
            $.ajax({
                url: "{{route('user.ajaxOrder')}}", // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    id_city: id_city, // giá trị id_city
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data) { // nhận kết quả trả về
                    // xoá hết option rạp cũ chỉ chừa lại option default
                    $('#theaters').html("<option value='" + "' >--Chọn--</option>");
                    $.each(data, function(index, theaters) {
                        // thêm các option rạp mới vào
                        $('#theaters').append('<option value="' + theaters.id + '">' + theaters.name + '</option>');
                    });

                }
            });
    })
    // xử lý gọi date theo rạp
    var theaterID='';
        $('#theaters').change(function() {
            var id_theater = $(this).val();
            theaterID = id_theater;
            var id_movie = '{{$movie->id}}';
            $.ajax({
                url: "{{route('user.ajaxOrder')}}", // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    id_theater: id_theater, // 
                    id_movie:id_movie,
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data) { // nhận kết quả trả về
                    $.each(data, function(index, dates) {
                        var dateDM = moment(dates.date).format('DD/MM');
                        $('#date').append(`<div class='col-1'><input type='radio' class='btn-check day_check' name='options-outlined' id='${dates.date}' autocomplete='off'><label class='btn btn-outline-danger' for='${dates.date}'><div class='text-xs font-weight-bold text-success'>
                                                ${dateDM}</div>
                                                <label class='text'>${dates.day_of_week}</label>
                                        </label>
                                    </div>`);
                    });
                }
            });
        })
    // gọi suất chiếu theo ngày - phim - rạp
    $(document).on('change', '.day_check', function (){
            var date_selected = $(this).attr('id');
            var id_movie = '{{$movie->id}}';
             $.ajax({
                url: "{{route('user.ajaxOrder')}}", // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    theaterID: theaterID, // 
                    id_movie:id_movie,
                    date_selected:date_selected,
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data) { // nhận kết quả trả về
                    $('#showtimes').empty();
                    $.each(data, function(index, showtimes) {
                        var startTime = moment().format('YYYY-MM-DD') + ' ' + showtimes.start_at;
                        var endTime = moment().format('YYYY-MM-DD') + ' ' + showtimes.end_at;
                        var start_at = moment(startTime, 'YYYY-MM-DD HH:mm:ss').format('HH:mm');
                        var end_at = moment(endTime, 'YYYY-MM-DD HH:mm:ss').format('HH:mm');
                        $('#showtimes').append(`<button class='col-2 btn btn-light border border-info rounded py-1 text-center mr-1 order' id='${showtimes.id}'>
                                                    ${start_at} ~ ${end_at}
                                                </button>`);
                        });
                }
            });
    });
    //gọi modal đặt vé theo suất chiếu
    $(document).on('click', '.order', function (){
        var id_showtime = $(this).attr('id');
        $.ajax({
                url: "{{route('user.ajaxOrder')}}", // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    id_showtime:id_showtime,
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data) { // nhận kết quả trả về
                   console.log(data)
                    var startTime = moment().format('YYYY-MM-DD') + ' ' + data.start_time;
                    var start_at = moment(startTime, 'YYYY-MM-DD HH:mm:ss').format('HH:mm');
                    var dateDM = moment(data.date).format('DD/MM/YYYY');
                    $('#infor').find('ul').find('li').find('#theater_name').text(data.theaterName);
                    $('#infor').find('ul').find('li').find('#theater_address').text(data.theaterAddress);
                    $('#infor').find('ul').find('li').find('#time_start').text(start_at);
                    $('#infor').find('ul').find('li').find('#showtime_date').text(dateDM);
                    $('#infor').find('ul').find('li').find('#movie_name').text('{{$movie->name}}');
                    $('#infor').find('ul').find('li').find('#showtime_price').text(data.price);
                    $('#infor').find('ul').find('li').find('#room_theater').text(' phòng chiếu:'+data.roomName);
                    //in ra sơ đồ ghế
                     $('#row_showtime').html('');
                     $('#column_showtime').html('');
                     console.log(data.roomSeats);
                    $.each(data.roomSeats, function(row, value) {
                        $('#row_showtime').append(`<tr>
                            <td>${row}</td>
                        </tr>`);
                        $('#column_showtime').append(`<tr id='row-${row}'></tr>`);
                        $.each(value, function(index, column) {
                            $(`#row-${row}`).append(`<td><input type='checkbox' class='btn-check day_check'  id='${row}${column}' ><label class='btn btn-outline-danger p-0' for='${row}${column}'>${row}${column}</label></td>`)
                         });
                    });
                   $('.buy-ticket').show(); 
                }
        }); 

    });
    // checklogin
    $('#gotocheckout').click(function(){ //bắt buộc login
        var checklogin = "{{Auth::check()}}";
        //kiểm tra đăng nhập
            if(!checklogin){
                $('#exampleModal').modal("show")
                return false;
            }else{
                $('.details-overview').show();
            }
        });
    }); //dấu đóng hàm ready
</script>
@endsection


    
    
   
    
  