<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected UserService $userService;

    protected AuthService $authService;

    /**
     * __construct
     *
     * @param UserService $exampleService
     */
    public function __construct(UserService $userService, AuthService $authService)
    {
        $this->userService = $userService;
        $this->authService = $authService;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function login()
    {
        return view('user.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('user.home');
        }
        return redirect()->back()->with('error', __('Thông tin không hợp lệ'));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(AuthRequest $request)
    {
        $data = $request->all();
        $createUser = $this->userService->addUser($data);
        $token = Str::random(64);
        $dataUserVerify = [
            'user_id' => $createUser->id,
            'token' => $token,
        ];

        $this->authService->createUserVerify($dataUserVerify);

        Mail::send('email.verificationEmail', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Xác nhận đăng ký');
        });

        return redirect()->route('user.confirm');
    }

    public function confirm()
    {
        return view('auth.confirmEmail');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if (Auth::check()) {
            return view('users');
        }

        return redirect()->route('user.login')->withSuccess('Opps! You do not have access');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('user.login');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function verifyAccount($token)
    {
        $verifyUser = $this->authService->findToken(['token' => $token]);
        if ($verifyUser) {
            return redirect()->route('user.login')->with('success', 'Đăng ký thành công');
        } else {
            return redirect()->route('user.login')->withErrors('Email của bạn chưa được xác minh, vui lòng thử lại.');
        }
    }

    public function forgotpassword()
    {
        return view('auth.forgotpassword');
    }

    public function postforgotpassword(Request $request)
    {

        $email = $request->email;
        $findEmail = $this->userService->findbyEmail(['email' => $email]);
        $token = Str::random(64);
        if ($findEmail) {
            $this->authService->createPasswordResset([
                'email' => $email,
                'token' => $token,
            ]);

            Mail::send('email.reset_password_email', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Thay đổi mật khẩu');
            });

            return view('auth.confirmEmail');
        } else {
            return redirect()->back()->withErrors('Không tìm thấy tài khoản của email này, vui lòng đăng ký tài khoản mới');
        }
    }

    // public function verifyPasswordReset($token)
    // {
    //     $verifyUser = $this->authService->findToken(['token' => $token]);
    //     if ($verifyUser) {
    //         return redirect()->route('login');
    //     } else {
    //         return redirect()->route('login')->withErrors('Đổi mật khẩu thất bại');
    //     }
    // }
}
