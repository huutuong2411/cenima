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
    /**
     * @OA\Post(
     * path="/api/register",
     * operationId="Register",
     * tags={"Register"},
     * summary="User Register",
     * description="User Register here",
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(),
     *
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *
     *            @OA\Schema(
     *               type="object",
     *               required={"name","email", "password", "password_confirmation"},
     *
     *               @OA\Property(property="name", type="text"),
     *               @OA\Property(property="email", type="text"),
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password")
     *            ),
     *        ),
     *    ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Register Successfully",
     *
     *          @OA\JsonContent()
     *       ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Register Successfully",
     *
     *          @OA\JsonContent()
     *       ),
     *
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *
     *          @OA\JsonContent()
     *       ),
     *
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
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

    /**
     * @OA\Post(
     * path="/api/login",
     * operationId="authLogin",
     * tags={"Login"},
     * summary="User Login",
     * description="Login User Here",
     *
     *     @OA\RequestBody(
     *
     *         @OA\JsonContent(),
     *
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *
     *            @OA\Schema(
     *               type="object",
     *               required={"email", "password"},
     *
     *               @OA\Property(property="email", type="email"),
     *               @OA\Property(property="password", type="password")
     *            ),
     *        ),
     *    ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Login Successfully",
     *
     *          @OA\JsonContent()
     *       ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Login Successfully",
     *
     *          @OA\JsonContent()
     *       ),
     *
     *      @OA\Response(
     *          response=422,
     *          description="Unprocessable Entity",
     *
     *          @OA\JsonContent()
     *       ),
     *
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     * )
     */
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
