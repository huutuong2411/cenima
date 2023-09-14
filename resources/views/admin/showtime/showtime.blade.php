@extends('Admin.layout.main')

@section('title')
Quản lý suất chiếu
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý suất chiếu</h1>
<div class="card shadow mb-4">
    <div class="card">
        <div class="card-header text-primary font-weight-bold">Danh sách suất chiếu<a style="float:right" href="{{route('admin.showtime_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm suất chiếu</a><a href="{{route('admin.showtime_trash')}}" class="btn btn-danger" style="float:right; margin-left:1%"><i class="fas fa-trash"></i> Thùng rác</a></div>

        <div class="card-body table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" data-order='[[ 0, "desc" ]]'>
                <thead>
                    <tr>
                        <th class="col-1">STT</th>
                        <th class="col-3">Rạp</th>
                        <th class="col-3">Ngày chiếu</th>
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
@endsection