@extends('Admin.layout.main')

@section('title')
Quản lý rạp phim
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý rạp chiếu</h1>
<div class="card shadow mb-4">

  <div class="row">
    <div class="card col-xl-12">
      <div class="card-header text-primary font-weight-bold">Danh sách rạp chiếu <button type="button" class="btn btn-primary float-right ml-2" id="add" data-toggle="modal" data-target="#addModal">Thêm mới rạp</button>
        <a href="{{route('admin.theaters_trash')}}" class="btn btn-danger float-right"><i class="fas fa-trash"></i> Thùng rác</a>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-bordered" id="dataTable" cellspacing="0">
          <thead>
            <tr>
              <th class="col-1">ID</th>
              <th>Tên</th>
              <th>Địa chỉ</th>
              <th class="col-3" style="text-align: center">Thao tác</th>
            </tr>
          </thead>

          <tbody>
            @foreach($theaters as $value)
            <tr>
              <input type="hidden" class="id_city" value="{{$value->id_city}}">
              <th scope="row" class="id">{{$value->id}}</th>
              <td class="name">{{$value->name}}</td>
              <td class="address">{{$value->address}}</td>
              <td style="text-align: center">
                <button type="button" class="btn btn-warning btn-circle btn-sm edit" data-toggle="modal" data-target="#editModal">
                  <i class="fas fa-pencil-alt"></i>
                </button>
                <a type="button" class="btn btn-danger btn-circle btn-sm deleteBrand" style="margin-left:10%"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="max-width: 76px!important;min-width: 461px!important;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Các phòng chiếu liên quan sẽ bị xoá theo rạp chiếu này
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <a href="" class="btn btn-danger stilldelete">Vẫn xoá</a>

      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Thêm mới rạp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('admin.theaters')}}" method="post">
          @csrf
          <div class="mb-3">
            <label class="text-primary">Chọn thành phố: </label>

            <select required class="form-select form-control" name="city">
              <option value="">--Chọn--</option>
              @foreach($city as $value)
              <option value="{{$value->id}}">{{$value->name}}</option>
              @endforeach
            </select>
          </div>
          <div class=" mb-3">
            <label class="small mb-1">Tên rạp</label>
            <input class="form-control" type="text" name="theater" value="" required>
          </div>
          <div class=" mb-3">
            <label class="small mb-1">Địa chỉ</label>
            <input class="form-control" type="text" name="address" value="" required>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sửa thông tin rạp</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="editbrand">
        <form action="{{route('admin.theaters')}}" method="post">
          @csrf
          <div class="mb-3">
            <label class="text-primary">Chọn thành phố: </label>
            <select required class="form-select form-control old_city" name="city">
              <option value="">--Chọn--</option>
              @foreach($city as $value)
              <option value="{{$value->id}}">{{$value->name}}</option>
              @endforeach
            </select>
          </div>
          <div class=" mb-3">
            <label class="small mb-1">Tên rạp cũ</label>
            <input class="form-control old_name" type="text" value="" readonly>
          </div>
          <div class=" mb-3">
            <label class="small mb-1">Tên rạp mới</label>
            <input class="form-control new_name" type="text" name="name" value="" required>
          </div>
          <div class=" mb-3">
            <label class="small mb-1">Địa chỉ cũ</label>
            <input class="form-control old_address" type="text" value="" readonly>
          </div>
          <div class=" mb-3">
            <label class="small mb-1">Địa chỉ mới</label>
            <input class="form-control new_address" type="text" name="address" value="" required>
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-warning">Lưu</button>
      </div>
      </form>
    </div>
  </div>
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $(".edit").click(function() {
      var id = $(this).closest('tr').find('.id').text();
      var id_city = $(this).closest('tr').find('.id_city').val();
      var name = $(this).closest('tr').find('.name').text();
      var address = $(this).closest('tr').find('.address').text();
      $("#editbrand form").attr("action", "{{route('admin.theaters_edit','') }}/" + id);
      $(".old_name").val(name);
      $(".new_name").val(name);
      $(".old_address").val(address);
      $(".new_address").val(address);
      $(".old_city").val(id_city);
    });
    $('.deleteBrand').click(function() {
      var id_theater = $(this).closest('tr').find('th.id').text();
      var URL = "{{url('admin/theaters/')}}" + "/" + id_theater + "/" + "delete";
      $('#exampleModal').find('a.stilldelete').attr('href', URL);
      $('#exampleModal').modal("show");
    });
  });
</script>

@endsection