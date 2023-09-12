@extends('Admin.layout.main')
@section('title')
Quản lý Phim
@endsection
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý phim</h1>
<div class="card shadow mb-4">

    <div class="card">
        <div class="card-header text-primary font-weight-bold">Danh sách phim<a href="{{route('admin.movies_trash')}}" class="btn btn-danger" style="float:right; margin-left:1%"><i class="fas fa-trash"></i> Thùng rác</a>

            <a style="float:right" href="{{route('admin.movies_create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm phim</a>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="col-1">ID</th>
                            <th class="col-2">Tên phim</th>
                            <th class="col-2">Poster</th>
                            <th class="col-2">Thể loại</th>
                            <th class="col-1">Th.lượng</th>
                            <th class="col-1">Đã bán</th>
                            <th class="col-3" style="text-align: center">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($movie as $value)
                        <tr>
                            <th scope="row">{{$value->id}}</th>
                            <td>{{$value->name}}</td>
                            <td><img style="max-width:100%;" src="{{asset('/admin/assets/img/movies/'.$value->image)}}"></td>
                            <td>{{$value->categories->name}}</td>
                            <td>{{$value->time}} phút</td>
                            <td>{{$value->total_sales}}</td>
                            <td style="text-align: center">
                                <a href="{{route('admin.movies_show',['id'=>$value->id])}}" style="margin-left:2%" class="btn btn-info btn-circle btn-sm show"><i class="fas fa-solid fa-eye"></i></a>
                                <a href="{{route('admin.movies_edit',['id'=>$value->id])}}" class="btn btn-warning btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-pencil-alt"></i></a>
                                <a href="{{route('admin.movies_delete',['id'=>$value->id])}}" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>

</div>

<!-- test -->

@endsection