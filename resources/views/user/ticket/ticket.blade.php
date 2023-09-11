@extends('user.layout.main')
@section('title')
Vé của bạn
@endsection
@section('content')

<!-- breadcrumb area start -->
<section class="breadcrumb-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-area-content">
                    <h1 >Vé phim của bạn - {{$order->showtime->movie->name}}</h1>
                </div>
            </div>
        </div>
    </div>
</section><!-- breadcrumb area end -->
<!-- transformers area start -->
<section class="transformers-area">
    <div class="container">
        <div class="transformers-box">
            <div class="flexbox-center">
                <div class="cardWrap">
                      <div class="card cardLeft">
                        <h1 class="text-danger text-center">{{$order->showtime->rooms->theaters->name}}</h1>
                        <hr class="text-danger">
                        <div>
                          <p class="text-danger">Phim:</p>
                          <span>{{$order->showtime->movie->name}}</span>
                        </div>
                        <div>
                          <p class="text-danger">Tên khách hàng:</p>
                          <span>{{$order->user->name}}</span>
                        </div>
                        <div>
                          <p class="text-danger">Email:</p>
                          <span>{{$order->user->email}}</span>
                        </div>
                        <div>
                          <p class="text-danger">Địa chỉ:</p>
                          <span>{{$order->showtime->rooms->theaters->address}}</span>
                        </div>
                      </div>
                      <div class="card cardRight text-center">
                        <div class="eye"></div>
                        <div class="mb-2">
                          <h4 class="text-danger">Số ghế</h4>
                          <span>
                            @foreach(json_decode($order->ticket) as $index => $column)
                                @foreach($column as $key => $value)
                                    {{$index.$value.','}}
                                @endforeach
                            @endforeach
                          </span>

                        </div>
                        <div class="mb-2">
                        <h4 class="text-danger">Phòng chiếu</h4>
                        <span>{{$order->showtime->rooms->name}}</span>
                        </div>
                         <div class="mb-2">
                        <h4 class="text-danger">Giờ chiếu</h4>
                        <span>{{$order->showtime->start_at}} ({{date('d/m/Y', strtotime($order->showtime->date))}})</span>
                        </div> 
                         <div class="mb-2">
                        <h4 class="text-danger">Tổng tiền</h4>
                        <h5 class="text-warning">{{number_format($order->total, 0, '.', ',')}} đ</h5>
                        </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
</section><!-- transformers area end -->

  
@endsection