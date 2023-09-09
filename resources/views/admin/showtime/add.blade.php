@extends('Admin.layout.main')

@section('title')
Thêm phòng chiếu
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thêm phòng chiếu<a style="float:right;" href="{{route('admin.rooms')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
<div class="card shadow mb-4">

    <form action="{{route('admin.showtime_add')}}" method="post"  id="form">
        @csrf
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header text-primary font-weight-bold">Thông tin phòng chiếu</div>
            <div class="card-body">
                <div class="receipt">
                    <div class="mb-3 row">
                        <div class="col-3">
                            <label class="text-primary">Chọn thành phố: </label>
                            <select required class="form-select form-control" name="city" id="city">
                                <option value="">--Chọn--</option>
                                @foreach($city as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-3">
                            <label class="text-primary">Chọn rạp: </label>
                            <select required class="form-select form-control" name="theater" id="theaters">
                                <option value="">--Chọn--</option>

                            </select>
                        </div>
                        <div class="col-3">
                            <label class="text-primary">Chọn phòng: </label>
                            <select required class="form-select form-control" name="room" id="rooms">
                                <option value="">--Chọn--</option>
                            </select>
                        </div>

                        <div class="col-3">
                        <label class="text-primary">Chọn ngày: </label>
                        <input required name="date" class="form-control" type="date">
                        </div>
                    </div>
                    
                    <hr class="primary">
                    <label class="text-primary">Thông tin suất chiếu: </label>
                    <div class="card border-left-info addrow">
                        <div class="card-body p-2 row" style="padding: 0.7rem;">
                            <div class="col-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        giờ bắt đầu</div>
                                <input type="time" class="form-control start_time" name="startTime[]">
                            </div>
                            <div class="col-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        giờ kết thúc</div>
                                <input type="time" class="form-control end_time" name="endTime[]" readonly>
                            </div>
                            <div class="col-3">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Chọn phim</div>
                               <select required class="form-select form-control movie" name="movie[]">
                                <option value="">--Chọn--</option>  
                                @foreach($movie as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>  
                                @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Giá vé:</div>
                                <input name="price[]" required name="price" class="form-control" type="text">
                            </div>
                            <div class="col-3">
                                 <div class="text-xs font-weight-bold text-success text-uppercase mb-1">&nbsp;
                                </div>
                                <button class="btn btn-danger btn-icon-split cancel float-right" type="button">Xoá suất chiếu</button>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
                <button class="btn btn-success buttonadd" type="button">Thêm suất chiếu</button>
                <button class="btn btn-primary" type="submit">Lưu thông tin</button>
            </div>

        </div>
    </form>



</div>


<script type="text/javascript">
    $(document).ready(function() {
        // xử lý gọi rạp theo location
        $('#city').change(function() {
            var id_city = $(this).val();
            $.ajax({
                url: "{{route('admin.rooms_add')}}", // đường dẫn đến controller
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

        // xử lý gọi phòng theo rạp
        $('#theaters').change(function() {
            var id_theater = $(this).val();
            $.ajax({
                url: "{{route('admin.showtime_add')}}", // đường dẫn đến controller
                method: 'POST', // phương thức POST
                data: { // dữ liệu gửi đi
                    id_theater: id_theater, // giá trị id_city
                    _token: '{{ csrf_token() }}' // token để bảo vệ form
                },
                success: function(data) { // nhận kết quả trả về
                    // xoá hết option phòng cũ chỉ chừa lại option default
                    $('#rooms').html("<option value='" + "' >--Chọn--</option>");
                    $.each(data, function(index, rooms) {
                        // thêm các option phòng mới vào
                        $('#rooms').append('<option value="' + rooms.id + '">' + rooms.name + '</option>');
                    });
                }
            });
        })

         // -------------------------- thêm suat chieu
        var lastAddRow = $(".addrow").last().clone(); //copy div  để nếu cần sẽ add thêm
        $('.buttonadd').on('click',function() { //sự kiện click thêm hàng
            var newShowtime= lastAddRow.clone();
            $(".receipt").append(newShowtime); // Thêm div B sao chép vào div A
        });

        // ----------- xử lý render ra thời gian kết thúc
        
            $(document).on('change', '.movie', function () {
                var movieId = $(this).val();
                var startTime = $(this).closest('.row').find('.start_time').val();
                var $this = $(this);
                 if (startTime) {
                    // Đã chọn thời gian bắt đầu, thực hiện AJAX
                    $.ajax({
                    type: 'POST',
                    url: '{{ route("admin.showtime_add") }}',
                    data: {
                        movie_id: movieId,
                        start_time: startTime,
                        _token: '{{ csrf_token() }}' // token để bảo vệ form
                    },
                    success: function (data) {
                            $this.closest('.row').find('.end_time').val(data.end_time);
                        }
                    });
                } else {
                    // Chưa chọn thời gian bắt đầu, hiển thị thông báo
                    $('.movie').val("");
                    alert('Vui lòng chọn thời gian bắt đầu trước khi chọn phim.');
                }
                });
        

        //----------------------Xoá suat chieu       
        $(document).on('click', '.cancel:not(:first)', function() { // nút xoá hàng ghế
            var lastButton = $(this).closest('.addrow').remove();
        });

        // dấu đóng hàm ready
    });
</script>
@endsection