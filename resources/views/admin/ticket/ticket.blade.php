@extends('Admin.layout.main')

@section('title')
Danh sách vé
@endsection

@section('content')

<h1 class="h3 mb-2 text-gray-800  border-bottom bg-white mb-4"><i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Danh sách vé đặt</h1>
<div class="card shadow mb-4">

    <div class="card">
        <div class="card-header text-primary font-weight-bold">Danh sách vé</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="dataTable" cellspacing="0" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th class="col-1">ID</th>
                        <th class="col-3">email</th>
                        <th class="col-2">phim</th>
                        <th class="col-2">Rạp</th>
                        <th class="col-2">Suất chiếu</th>
                        <th class="col-2">Tổng tiền</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($tickets as $value)
                    <tr>
                        <th class="id" scope="row">{{$value->id}}</th>
                        <td>{{$value->user->email}}</td>
                        <td>{{$value->showtime->movie->name}}</td>
                        <td>{{$value->showtime->rooms->theaters->name}}</td>
                        <td>{{$value->showtime->start_at}} ({{date('d/m/Y', strtotime($value->showtime->date))}})</td>
                        <td>{{number_format($value->total, 0, '.', ',')}} đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- test -->

@endsection