@extends('Admin.layout.main')

@section('title')
Chi tiết suất chiếu
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Chi tiết suất chiếu<a style="float:right;" href="{{route('admin.showtime')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
<div class="card shadow mb-4">
    <!-- Account details card-->
    <div class="card mb-4">
        <div class="card-header text-primary font-weight-bold">Chi tiết phòng chiếu</div>
        <div class="card-body">
            <div class="card border-left-info mb-4">
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Thành phố:{{$theater->cities->name}} </label>
                    <label></label>
                </div>
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Tên rạp: {{$theater->name}} </label>
                    <label></label>
                </div>
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Ngày chiếu: {{$showtime[0]->date}} </label>
                    <label></label>
                </div>

            </div>

            @foreach($showtime as $value)
            <div class="mb-3 row">
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold text-primary">Tên phòng chiếu: {{$value->rooms->name}}</label>
                    <label class="font-weight-bold"></label>
                </div>
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Suất chiếu: {{$value->start_at}} - {{$value->end_at}} </label>
                    <label></label>
                </div>
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Giá: {{$value->price}}</label>
                    <label></label>
                </div>
            </div>
            @endforeach

            <hr class="primary">
        </div>
    </div>
</div>
@endsection