@extends('Admin.layout.main')

@section('title')
Chi tiết phòng chiếu
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Chi tiết phòng chiếu<a style="float:right;" href="{{route('admin.rooms')}}" class="btn btn-danger col-1"><i class="fas fa-sharp fa-solid fa-arrow-left"></i> Quay lại</a></h1>
<div class="card shadow mb-4">
    <!-- Account details card-->
    <div class="card mb-4">
        <div class="card-header text-primary font-weight-bold">Chi tiết phòng chiếu</div>
        <div class="card-body">
            <div class="mb-3 row">
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold text-primary">Tên phòng chiếu:</label>
                    <label class="font-weight-bold">{{$room->name}}</label>
                </div>
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Tên rạp: </label>
                    <label>{{$theater}}</label>
                </div>
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Thành phố: </label>
                    <label>{{$city}}</label>
                </div>
                <div class="col-3">
                    <label class="small mb-1 font-weight-bold ml-3 text-primary">Số lượng ghế: </label>
                    <label>{{$room->seat_qty}}</label>
                </div>
            </div>
            <hr class="primary">
            <label class="text-primary">Sơ đồ ghế ngồi: </label>
            <div class="card border-left-info addrow">
                @foreach(json_decode($room->seats) as $row => $value)
                <div class="card-body row p-2">
                    <div class="col-1">
                        <a href="#" class="btn btn-info btn-circle btn-sm rowChar">{{$row}}</a>
                    </div>
                    <div class="col-10 rowSeat border border-info rounded">
                        @foreach($value as $seat)
                        <button type="button" class='btn btn-secondary btn-sm ml-1'>{{$seat}}</button>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>



</div>


@endsection