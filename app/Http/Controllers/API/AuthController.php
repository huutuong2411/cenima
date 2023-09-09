<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use App\Traits\APIResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use APIResponse;

    protected UserService $userService;

    /**
     * __construct
     *
     * @param UserService $exampleService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function register(AuthRequest $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt($request->password);
        $user = $this->userService->addUser($input);
        $success['token'] = $user->createToken('MyAccount')->accessToken;
        echo $success['token'];
        exit;
        $success['name'] = $user->name;

        return response()->json(
            [
                'success' => $success,
            ],
            200
        );
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('app')->accessToken;
            $success['name'] = $user->name;

            return $this->responseSuccessWithData($success);
        } else {
            return $this->responseError('Unauthorised');
        }
    }
}
