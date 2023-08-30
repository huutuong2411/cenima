@extends('Admin.layout.main')
@section('title')
Thống kê - Báo Cáo
@endsection
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Quản lý Sản phẩm</h1>
        @if(session('delete'))
            <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              {{session('delete')}}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
            <ul>
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                @endforeach
            </ul>
            </div>
        @endif
        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                {{session('success')}}
            </div>
        @endif
<div class="card shadow mb-4">
                        
                        <div class="card">
                            <div class="card-header text-primary font-weight-bold">Danh sách phim<a href="" class="btn btn-danger" style="float:right; margin-left:1%"><i class="fas fa-trash"></i> Thùng rác</a>
                           
                            <a style="float:right" href="" class="btn btn-primary"><i class="fas fa-plus"></i> Thêm sản phẩm</a>
                            
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th class="col-1">ID</th>
                                                <th class="col-2">Tên sản phẩm</th>
                                                <th class="col-2">Hình ảnh</th>
                                                <th class="col-1">Giá</th>
                                                <th class="col-1">Giảm giá</th>
                                                <th class="col-1">Số lượng</th>
                                                <th class="col-1">Đánh giá</th>
                                                <th class="col-1">Đã bán</th>
                                                <th class="col-2" style="text-align: center">Thao tác</th>
                                            </tr>
                                        </thead>
                                       
                                        <tbody>
                                            @foreach($movie as $value)
                                            <tr>   
                                                <th scope="row"></th>
                                                <td></td>
                                              
                                                <td><img style="max-width:100%;" src=""></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <label style="display:none"></label>
                                                </td>
                                                <td></td>
                                                
                                                <td style="text-align: center">
                                                    <a href="" class="btn btn-info btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-solid fa-eye"></i></a>
                                                 
                                                    <a href="" class="btn btn-warning btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-pencil-alt"></i></a>
                                                    <a href="" class="btn btn-danger btn-circle btn-sm" style="margin-left:2%"><i class="fas fa-trash"></i></a>
                                                
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





                           
                            
