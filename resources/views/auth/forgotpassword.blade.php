@extends('layouts.main')

@section('content')


<div class="col-6 mx-auto justify-content-center align-items-center h-100">
    <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
            {{session('success')}}
        </div>
        @endif
        <form method="post" action="{{route('user.post_forgotpassword')}}">
            @csrf
            <div class="card text-center">
                <div class="card-header h5 text-white bg-primary">Password Reset</div>
                <div class="card-body px-5">
                    <p class="card-text py-2">
                        Nhập vào email của bạn và chúng tôi sẽ gửi 1 email để thay đổi mật khẩu
                    </p>
                    <div class="form-outline">
                        <input type="email" name="email" id="typeEmail" class="form-control my-3" />
                        <label class="form-label" for="typeEmail">Email của bạn</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset password</button>
                    <div class="d-flex justify-content-between mt-4">
                        <a class="" href="{{route('user.login')}}">Login</a>
                        <a class="" href="#">Register</a>
                    </div>
                </div>
            </div>
        </form>
        @if ($errors->any())
        @foreach ($errors->all() as $error)
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{$error}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        @endforeach
        @endif
    </div>
</div>
@endsection