<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\UserService;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Traits\APIResponse;

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
        $success['token'] =  $user->createToken('MyAccount')->accessToken;
        echo $success['token'];
        die;
        $success['name'] =  $user->name;


        return response()->json(
            [
                'success' => $success
            ],
            200
        );
    }

    public function login(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            $success['token'] =  $user->createToken('app')->accessToken;
            $success['name'] =  $user->name;

            return $this->responseSuccessWithData($success);
        } else {
            return $this->responseError('Unauthorised');
        }
    }
}
