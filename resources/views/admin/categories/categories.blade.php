@extends('Admin.layout.main')

@section('title')
Quản lý danh mục
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý danh mục</h1>
@if(session('delete'))
<div class="alert alert-danger">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
  {{session('delete')}}
</div>
@endif
<div class="card shadow mb-4">

  <div class="row">
    <div class="card col-xl-6">
      <div class="card-header text-primary font-weight-bold">Danh sách danh mục <a href="{{route('admin.trash_categories')}}" class="btn btn-danger" style="float:right"><i class="fas fa-trash"></i> Thùng rác</a></div>
      <div class="card-body table-responsive">
        <table class="table table-bordered" id="dataTable" cellspacing="0">
          <thead>
            <tr>
              <th class="col-1">ID</th>
              <th>Tên</th>

              <th class="col-3" style="text-align: center">Thao tác</th>

            </tr>
          </thead>

          <tbody>
            @foreach($categories as $value)
            <tr>
              <th scope="row" class="id">{{$value->id}}</th>
              <td class="name">{{$value->name}}</td>

              <td style="text-align: center">
                <button type="button" class="btn btn-warning btn-circle btn-sm edit"><i class="fas fa-pencil-alt"></i></button>
                <a type="button" class="btn btn-danger btn-circle btn-sm deleteCategory" style="margin-left:10%"><i class="fas fa-trash"></i></a>
              </td>

            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="card col-xl-6">
      <div class="card-header text-primary font-weight-bold" id="add_heading">Thêm danh mục phim</div>
      <!--form thêm danh mục  -->
      <div class="card-body" id="addcategory">
        <form action="{{route('admin.categories_add')}}" method="post">
          @csrf
          <div class=" mb-3">
            <label class="small mb-1">Tên danh mục</label>
            <input class="form-control" type="text" name="category" value="" required>
          </div>
          <button type="submit" class="btn btn-primary">Lưu</button>
        </form>
      </div>
      <!--đóng form thêm danh mục  -->

      <div class="card-header text-warning font-weight-bold" id="edit_heading" style="display: none">Sửa danh mục phim</div>
      <!-- form edit danh mục -->
      <div class="card-body" id="editcategory" style="display: none">
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
        <form action="" method="post">
          @csrf
          <div class=" mb-3">
            <label class="small mb-1">Tên danh mục cũ</label>
            <input class="form-control old_category" type="text" value="" readonly>
          </div>
          <div class=" mb-3">
            <label class="small mb-1">Tên danh mục mới</label>
            <input class="form-control new_category" type="text" name="new_name" value="" required>
          </div>
          <button type="submit" class="btn btn-warning">Lưu</button>
          <button type="button" class="btn btn-primary" id="add" style="margin-left:10%">Thêm mới danh mục</button>
        </form>
      </div>
      <!-- đóng form edit danh mục -->
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
        Các sản phẩm liên quan sẽ bị xoá theo danh mục này
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
        <a href="" class="btn btn-danger stilldelete">Vẫn xoá</a>

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {


    $(".edit").click(function() {
      $("#add_heading").hide();
      $("#addcategory").hide();
      $("#edit_heading").show();
      $("#editcategory").show();
      var id = $(this).closest('tr').find('.id').text();
      var name = $(this).closest('tr').find('.name').text();
      $("#editcategory form").attr("action", "{{route('admin.categories_edit','') }}/" + id);
      $(".old_category").val(name);
      $(".new_category").val(name);
    });
    $("#add").click(function() {
      $("#edit_heading").hide();
      $("#editcategory").hide();
      $("#add_heading").show();
      $("#addcategory").show();
    });
  });
  $('.deleteCategory').click(function() {
    var id_category = $(this).closest('tr').find('th.id').text();
    var URL = "{{url('admin/categories/')}}" + "/" + id_category + "/" + "delete";
    $('#exampleModal').find('a.stilldelete').attr('href', URL);
    $('#exampleModal').modal("show");
  });
</script>

@endsection