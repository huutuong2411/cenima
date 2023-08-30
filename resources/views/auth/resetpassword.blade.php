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
        <form method="post" action="{{route('user.post_resetpassword',['id'=>$id])}}">
            @csrf
            <div class="card text-center">
                <div class="card-header h5 text-white bg-primary">Password Reset</div>
                <div class="card-body px-5">
                    <p class="card-text py-2">
                        Nhập vào mật khẩu mới và xác nhận lại mật khẩu
                    </p>
                    <div class="form-outline">
                        <input type="password" name="password" id="typeEmail" class="form-control my-3" />
                        <label class="form-label" for="typeEmail">Mật khẩu mới</label>
                    </div>
                    <div class="form-outline">
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control my-3" />
                        <label class="form-label" for="password_confirmation">Nhập lại mật khẩu</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Reset password</button>
                    @if ($errors->has('password'))
                        <p class="text-danger">*{{ $errors->first('password') }}</p>
                    @endif
                    <div class="d-flex justify-content-between mt-4">
                        <a class="" href="#">Login</a>
                        <a class="" href="#">Register</a>
                    </div>
                </div>
            </div>
        </form>
                     @if(session('error'))
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            {{session('error')}}
                                        </div>
                                        @endif
    </div>
</div>
@endsection