@extends('Admin.layout.main')

@section('title')
Danh mục-thùng rác
@endsection

@section('content')
	
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Danh mục - thùng rác</h1>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                        {{session('success')}}
            </div>
         @endif
<div class="card shadow mb-4">
                        
                      
                        <div class="card">
                          <div class="card-header text-primary font-weight-bold">Danh sách danh mục đã xoá<a style="float: right;" href="{{route('admin.category')}}" class="btn btn-danger"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered" id="dataTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="col-1">ID</th>
                                            <th>Tên</th>
                                            @if(Auth::user()->id_role==1)
                                            <th class="col-2" style="text-align: center">Thao tác</th>
                                            @endif
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @foreach($trash as $value)
                                        <tr>
                                            <th scope="row">{{$value->id}}</th>
                                            <td class="name">{{$value->name}}</td>
                                            @if(Auth::user()->id_role==1)
                                            <td style="text-align: center">
                                                <a href="{{route('admin.category.restore',['id'=>$value->id])}}" class="btn btn-warning"><i class="fas fa-retweet"></i> Khôi phục</a>
                                            </td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    
                       

</div>
@endsection
