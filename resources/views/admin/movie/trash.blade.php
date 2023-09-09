@extends('Admin.layout.main')

@section('title')
Phim - thùng rác
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Phòng chiếu - thùng rác<a style="float:right;" href="{{route('admin.movies')}}" class="btn btn-sm btn-danger"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>

<div class="card shadow mb-4">
    <div class="card">
        <div class="card-header text-primary font-weight-bold">Danh sách phòng chiếu đã xoá</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0">
                <thead>
                   <tr>
                            <th class="col-1">ID</th>
                            <th class="col-2">Tên phim</th>
                            <th class="col-2">Poster</th>
                            <th class="col-3">Thể loại</th>
                            <th class="col-1">Th.lượng</th>
                            <th class="col-1">Đã bán</th>
                            <th class="col-2" style="text-align: center">Thao tác</th>
                        </tr>
                </thead>

                <tbody>
                    @foreach($trash as $value)
                    <tr>
                         <th scope="row">{{$value->id}}</th>
                            <td>{{$value->name}}</td>
                       <td><img style="max-width:100%;" src="{{asset('/admin/assets/img/movies/'.$value->image)}}"></td>
                        <td><iframe width="560" height="315" src="{{$value->trailer}}" frameborder="0" allowfullscreen></iframe></td>
                        <td>{{$value->time}} phút</td>
                        <td></td>
                        <td style="text-align: center">
                            <a href="{{route('admin.movies_restore',['id'=>$value->id])}}" class="btn btn-warning"><i class="fas fa-retweet"></i> Khôi phục</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection