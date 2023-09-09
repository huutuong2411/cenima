@extends('Admin.layout.main')

@section('title')
Thêm phòng chiếu
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thêm phòng chiếu<a style="float:right;" href="{{route('admin.rooms')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
<div class="card shadow mb-4">

    <form action="{{route('admin.rooms_add')}}" method="post" id="form">
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
                        <div class="col-5">
                            <label class="text-primary">Chọn rạp: </label>
                            <select required class="form-select form-control" name="theaters" id="theaters">
                                <option value="">--Chọn--</option>

                            </select>
                        </div>
                        <div class="col-2">
                            <label class="text-primary">Tên phòng: </label>
                            <input required name="name" class="form-control price" type="text" placeholder="Nhập tên phòng chiếu">
                        </div>
                        <div class="col-2">
                            <label class="text-primary">Tổng số ghế: </label>
                            <input readonly id="total_seat" name="total_seats" class="form-control" type="text">
                        </div>
                    </div>
                    <hr class="primary">
                    <label class="text-primary">Sơ đồ ghế ngồi: </label>
                    <div class="card border-left-info addrow">
                        <div class="card-body row p-2" style="padding: 0.7rem;">
                            <div class="col-1">
                                <a href="#" class="btn btn-info btn-circle btn-sm rowChar">A</a>
                            </div>
                            <div class="col-8 rowSeat border border-info rounded">
                            </div>
                            <div class="col-1">
                                <button class="btn btn-warning btn-icon-split addSeat" type="button">Thêm ghế</button>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger btn-icon-split deletSeat" type="button">Xoá ghế</button>
                            </div>
                            <div class="col-1">
                                <button class="btn btn-danger btn-icon-split cancel" type="button">Xoá hàng</button>
                            </div>

                        </div>
                    </div>
                </div>
                <hr>
                <button class="btn btn-success buttonadd" type="button">Thêm hàng</button>
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

        //---------------- Xử lý tính tổng số ghế
        function updateTotalSeats() {
            var totalSeats = 0;
            totalSeats = $('.rowSeat').find("input").length;
            $('#total_seat').val(totalSeats);
        }
        //----------cập nhật lại ký tự hàng
        function updateRowNames() {
            $('.addrow').each(function(index) {
                $(this).find('.rowChar').text(String.fromCharCode(65 + index)); // 65 là mã ASCII cho ký tự 'A'
            });
        }
        // -------------------------- thêm hàng ghế

        $('.buttonadd').click(function() { //sự kiện click thêm hàng
            var lastAddRow = $(".addrow").last().clone(); //copy div  để nếu cần sẽ add thêm
            lastRow = $(".addrow").last().find(".rowChar").text();
            lastAddRow.find(".rowChar").text(String.fromCharCode(lastRow.charCodeAt(0) + 1))
            lastAddRow.find(".rowSeat").empty();
            $(".receipt").append(lastAddRow); // Thêm div B sao chép vào div A
            updateTotalSeats();
        });
        //-------------------------Thêm ghế mỗi hàng   

        $(document).on('click', '.addSeat', function() { //sự kiện click thêm ghế
            var row = $(this).closest('.card-body').find('.rowChar').text();
            var lastButton = $(this).closest('.card-body').find('.rowSeat').find("input").last();
            var numberSeat = lastButton.length > 0 ? parseInt(lastButton.val()) + 1 : 1;
            $(this).closest('.card-body').find('.rowSeat').append(`<button type="button" class='btn btn-secondary btn-sm ml-1'>${numberSeat}<input type='hidden' name='seats[${row}][]' value='${numberSeat}'></button>`);
            updateTotalSeats();

        });

        //-------------------------Xoá ghế mỗi hàng   
        $(document).on('click', '.deletSeat', function() { //sự kiện click thêm ghế
            var ButtonSeat = $(this).closest('.card-body').find('.rowSeat').find("button");
            if (ButtonSeat.length > 1) {
                ButtonSeat.last().remove();
                updateTotalSeats();
            } else {
                // Nếu chỉ còn 1 ghế, không cho phép xoá ghế cuối cùng
                alert('Phải giữ lại ít nhất một ghế trong hàng!');
            }
        });

        //----------------------Xoá hàng ghế        
        $(document).on('click', '.cancel:not(:first)', function() { // nút xoá hàng ghế
            var lastButton = $(this).closest('.addrow').remove();
            updateTotalSeats();
            updateRowNames(); // Cập nhật tên hàng
        });

        // dấu đóng hàm ready
    });
</script>
@endsection