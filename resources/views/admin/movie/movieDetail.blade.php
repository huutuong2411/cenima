@extends('Admin.layout.main')

@section('title')
Phim {{$movie->name}}
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Chi tiết "{{$movie->name}}"<a style="float:right;" href="{{route('admin.movies')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
<div class="card shadow mb-4">
    <!-- Account details card-->
    <div class="card mb-4">
        <div class="card-header text-primary font-weight-bold">Chi tiết "{{$movie->name}}"</div>
          <div class="card-body">
                <div class="mb-3 row">
                    <div class="col-4">
                    <label class="small mb-1 font-weight-bold text-primary text-lg">Tên phim: </label>
                    <label class="font-weight-bold text-lg"> {{$movie->name}}</label>
                    </div>
                    <div class="col-3">
                        <label class="small mb-1 font-weight-bold text-primary text-lg">Danh mục: </label>
                        <label class="font-weight-bold text-lg"> {{$movie->Categories->name}}</label>
                    </div>
                    <div class="col-3">
                        <label class="small mb-1 font-weight-bold text-primary text-lg ml-5">Giới hạn tuổi: </label>
                        <label class="font-weight-bold text-lg"> {{$movie->age_limit}} +</label>
                    </div>
                    
                </div>
                <div class="mb-3 row">
                     <div class="col-4">
                        <label class="small mb-1 font-weight-bold text-primary text-lg">Ngày khởi chiếu: </label>
                        <label class="font-weight-bold text-lg"> {{$movie->start_date}} </label>
                    </div>
                    <div class="col-3">
                        <label class="small mb-1 font-weight-bold text-primary text-lg">Thời lượng: </label>
                        <label class="font-weight-bold text-lg"> {{$movie->time}} phút</label>
                    </div>
                </div>
                 <label class="small mb-1 font-weight-bold text-primary text-lg">Poster: </label>
                <div class="mb-3">
                     
                <img src="{{asset('/admin/assets/img/movies/'.$movie->image)}}" id='imgPreview' alt="">
                </div>
               
                <div class="mb-3">
                     <label class="small mb-1 font-weight-bold text-lg">Link trailer: </label>
                    <a class="font-weight-bold text-lg" target="_blank" href="{{$movie->trailer}}">{{$movie->trailer}}</a>
                </div>
                <div class="mb-10">
                    <label class="small mb-1 font-weight-bold text-primary text-lg">Mô tả: </label>
                    <p>{!!$movie->description!!}</p>
                </div>
               
            </div>
    </div>



</div>


@endsection