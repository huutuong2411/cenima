@extends('Admin.layout.main')

@section('title')
Quản lý suất chiếu
@endsection

@section('content')
  
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý suất chiếu</h1>
<div class="card shadow mb-4">
                        <div class="card">
                          <div class="card-header text-primary font-weight-bold">Danh sách suất chiếu<a style="float:right" href="{{route('admin.showtime_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm suất chiếu</a></div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0" data-order='[[ 0, "desc" ]]'>
                                    <thead>
                                        <tr>
                                            <th class="col-1">STT</th>
                                            <th class="col-3">Ngày chiếu</th>
                                            <th class="col-3">Rạp</th>
                                            <th class="col-3">Thành phố</th>
                                            <th class="col-2" style="text-align: center">Thao tác</th>
                                        </tr>
                                    </thead>
                                    
                                     @foreach($showtime as $value)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{$value->theater_name}}</td>
                                            <td>{{$value->date}}</td>
                                            <td>{{$value->city_name}}</td>
                                            <td style="text-align: center">
                                                <a href="{{route('admin.showtime_show',['idTheater'=>$value->theater_id,'date'=>$value->date])}}" style="margin-left:2%" class="btn btn-info btn-circle btn-sm show"><i class="fas fa-solid fa-eye"></i></a>
                                                <a href="" class="btn btn-warning btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                     @endforeach
                                </table>
                            </div> 
                        </div>
</div>

<!-- test -->




<div class="modal bd-example-modal-lg" id="showdetail" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  
</div>
<!-- Button trigger modal -->



<script type="text/javascript">
 
    $(document).ready(function(){
       $('.show').click(function(){
            $('#showdetail').removeClass('fade show');
            var id_showtime = $(this).closest('tr').find('.id').text(); // lấy id showtime
            $.ajax({
                url:
                method: 'GET', // phương thức GET
                data: { // dữ liệu gửi đi
                   
                },
                success: function(data){ // nhận kết quả trả về
                    
                    if(data != ""){
                  var date = moment(data.showtime.date).format('DD/MM/YYYY'); // định dạng lại ngày
                 // xoá hết khung hoá đơn cũ thêm hoá đơn mới
                  $('#showdetail').html("<div style='max-width: 70%;' class='modal-dialog modal-lg'>"+
                                        "<div class='modal-content'>"+
                                            "<div class='card-body'>"+
                                            "<h3 class='text-center'>HOÁ ĐƠN NHẬP HÀNG</h3>" + 
                                            "<div class='mb-3 row'>"+
                                                "<div class='col-6'>"+
                                                        "<label class='mb-1 font-weight-bold'>Nhà cung cấp:</label>"+
                                                        "<label>"+ data.showtime.vendor+"</label>"+
                                                "</div>"+
                                                "<div class='col-6'>"+
                                                        "<label class='mb-1 font-weight-bold'>Ngày nhập:</label>"+
                                                        "<label>"+date+"</label>"+
                                                "</div>"+
                                            "</div>"+    
                                                "<hr class='primary'>"+
                                            "<table class='table table-bordered'>"+
                                                "<thead>"+
                                                    "<tr>"+
                                                        "<th style='text-align: center'>STT</th>"+
                                                        "<th>Tên sản phẩm</th>"+
                                                        "<th>Size</th>"+
                                                        "<th>Số lượng</th>"+
                                                        "<th>Đơn giá</th>"+
                                                        "<th>Thành tiền</th>"+
                                                    "</tr>"+
                                                "</thead>"+
                                                "<tbody>"+
                                                "</tbody>"+
                                            "</table>"+
                                        "<label class='float-right font-weight-bold col-3'>Chữ ký người nhận</label>"+
                                        "<br>" +
                                        "<br>" +
                                        "<br>" +
                                        "</div>"+
                                            "<div class='modal-footer'>"+
                                               "<a href='{{ url('admin/showtime/print')}}"+"/"+id_showtime+"' type='button' target='_blank' class='btn btn-sm btn-success'>In pdf</a>"+
                                                "<button type='button' class='btn btn-sm btn-secondary' data-dismiss='modal'>Đóng</button>"+
                                              "</div>"+
                                        "</div>"+
                                      "</div>"
                                    );
                } 
                var total_money=0;
                var i=0;
                $.each(data.groupDetails, function(key, value) {
                    $.each(value, function(index, detail) {
                        total_money += detail.sum_money;
                        var price = detail.price.toLocaleString('en-US');
                        var sum_money = detail.sum_money.toLocaleString('en-US');
                        i++
                            $('#showdetail').find('tbody').append("<tr>"+
                                                            "<td style='text-align: center'>"+i+"</td>"+
                                                            "<td>"+detail.product_name+"</td>"+
                                                            "<td>"+detail.size_name+"</td>"+
                                                            "<td>"+detail.qty+"</td>"+
                                                            "<td>"+price+"</td>"+
                                                            "<td>"+sum_money+"</td>"+
                                                            "</tr>");
                    });
                });
                total_money= total_money.toLocaleString('en-US');
                $('#showdetail').find('tbody').append("<tr class='font-weight-bold'>"+
                                                             "<td colspan='6'>Tổng tiền thanh toán:<p class='float-right'>"+total_money+"</p></td>"+   
                                                        "</tr>");

             }
            });  // dấu đóng AJAX
        
      }); // dấu đóng hàm show

      
// dấu đóng hàm ready
});

</script>
@endsection

