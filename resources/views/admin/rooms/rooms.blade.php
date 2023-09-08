@extends('Admin.layout.main')

@section('title')
Quản lý nhập kho
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý nhập kho</h1>
<div class="card shadow mb-4">

    <div class="card">
        <div class="card-header text-primary font-weight-bold">Danh sách đơn nhập<a href="{{route('admin.rooms_trash')}}" class="btn btn-danger" style="float:right; margin-left:1%"><i class="fas fa-trash"></i> Thùng rác</a><a style="float:right" href="{{route('admin.rooms_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm phòng</a></div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" data-order='[[ 0, "desc" ]]'>
                <thead>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-2">Phòng</th>
                        <th class="col-2">Rạp</th>
                        <th class="col-1">Số ghế</th>
                        <th class="col-2">Thành phố</th>
                        <th class="col-2" style="text-align: center">Thao tác</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($rooms as $value)
                    <tr>
                        <th class="id" scope="row">{{$value->id}}</th>
                        <td>{{$value->name}}</td>
                        <td>{{$value->Theaters->name}}</td>
                        <td>{{$value->seat_qty}}</td>
                        <td>{{$value->Theaters->Cities->name}}</td>
                        <td style="text-align: center">
                            <a href="{{route('admin.rooms_show',['id'=>$value->id])}}" style="margin-left:2%" class="btn btn-info btn-circle btn-sm show"><i class="fas fa-solid fa-eye"></i></a>
                            <a href="{{route('admin.rooms_edit',['id'=>$value->id])}}" class="btn btn-warning btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-pencil-alt"></i></a>
                            <a href="{{route('admin.rooms_delete',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection