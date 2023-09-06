<h1>Email Verification Mail</h1>

Please verify your email to resetpassword with bellow link:

<a href="{{ route('user.link_resetpassword', ['token'=>$token]) }}">reset password</a>