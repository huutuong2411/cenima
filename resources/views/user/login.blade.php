<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        .form-outline .form-control:focus {
            box-shadow: none !important;
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="vh-100" style="background-color: #9A616D;">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                        @if(session('success'))
                                          <div class="alert alert-success alert-dismissible">
                                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                          <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                              {{session('success')}}
                                  </div>
                              @endif
                            <div class="row g-0">
                                <div class=" col-lg-6 d-none d-md-block">
                                    <img src="https://png.pngtree.com/thumb_back/fw800/back_our/20190620/ourmid/pngtree-latest-movie-poster-design-image_163485.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem; " />
                                </div>
                                <div class=" col-lg-6 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        
                                        <form method="post" action="{{route('user.login_post')}}">
                                            @csrf
                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <div class="d-flex align-items-center mb-3 pb-1">
                                                    <img src="{{asset('user/assets/img/logo.png')}}" alt="">
                                                </div>
                                            </div>

                                            <h5 class="fw-normal mb-3 pb" style="letter-spacing: 1px;">Sign into your account</h5>

                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="form2Example17">Email address</label>
                                                <input type="email" id="form2Example17" class="form-control form-control-lg" name="email" />
                                                @if ($errors->has('email'))
                                                <p class="text-danger">*{{ $errors->first('email') }}</p>
                                                @endif
                                            </div>

                                            <div class="form-outline mb-3">
                                                <label class="form-label" for="form2Example27">Password</label>
                                                <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" />
                                                @if ($errors->has('password'))
                                                <p class="text-danger">*{{ $errors->first('password') }}</p>
                                                @endif
                                            </div>

                                            <div class="pt-1 mb-3">
                                                <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                            </div>

                                            <a class="small text-muted" href="{{route('user.forgotpassword')}}">Forgot password?</a>
                                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="{{route('user.register')}}" style="color: #393f81;">Register here</a></p>
                                        </form>
                                        @if(session('error'))
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            {{session('error')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>