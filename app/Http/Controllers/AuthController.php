<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Jobs\SendMailVerify;
use App\Services\AuthService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        dispatch(new SendMailVerify($request->email, $token, 'Xác nhận đăng ký', 'email.verificationEmail'));

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
            dispatch(new SendMailVerify($email, $token, 'Reset password', 'email.reset_password_email'));

            return view('auth.confirmEmail');
        } else {
            return redirect()->back()->withErrors('Không tìm thấy tài khoản của email này, vui lòng đăng ký tài khoản mới');
        }
    }

    public function verifyPasswordReset($token)
    {
        $verifyPassword = $this->authService->findResetPassword(['token' => $token]);

        $id = $this->userService->findbyEmail(['email' => $verifyPassword->email])->id;
        $timeDifference = now()->diffInMinutes($verifyPassword->updated_at);
        if (is_null($verifyPassword)) {
            return redirect()->route('user.forgotpassword')->withErrors('Link xác thực không hợp lệ');
        } elseif ($timeDifference > 5) {
            return redirect()->route('user.forgotpassword')->withErrors('Link xác thực hết hạn');
        } else {
            return redirect()->route('user.resetpassword', ['id' => $id]);
        }
    }

    public function resetpassword($id)
    {
        return view('auth.resetpassword', compact('id'));
    }

    public function updatepassword(ResetPasswordRequest $request, string $id)
    {
        // $confirmation_code = time() . uniqid(true);
        $data['password'] = Hash::make($request->password);
        // $filter['confirmation_code'] = $confirmation_code;
        if ($this->userService->updateUser($id, $data)) {
            return redirect()->route('user.login')->with('success', 'Đổi mật khẩu thành công');
        } else {
            return redirect()->route('user.login')->withErrors('Đổi mật khẩu không thành công');
        }
    }
}
