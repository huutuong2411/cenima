<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Notifications\ResetPasswordRequest as ResetPasswordNotification;
use App\Services\AuthService;
use App\Services\UserService;
use App\Traits\APIResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

    protected AuthService $authService;

    protected UserService $userService;

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

    public function register(AuthRequest $request)
    {
        $input = $request->all();

        $input['password'] = bcrypt($request->password);
        $user = $this->userService->addUser($input);
        $success['token'] = $user->createToken('MyAccount')->accessToken;
        echo $success['token'];
        exit;
        $success['name'] = $user->name;

        return response(
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

    /**
     * @OA\Post(
     *     path="/api/forgot-password",
     *     operationId="forgotPassword",
     *     tags={"Authentication"},
     *     summary="Forgot password",
     *     description="Forgot password.",
     *
     *     @OA\RequestBody(
     *
     *          @OA\JsonContent(),
     *         required=true,
     *
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *
     *            @OA\Schema(
     *               type="object",
     *               required={"email"},
     *
     *               @OA\Property(property="email", type="email"),
     *            ),
     *        ),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="We have e-mailed your password reset link!",
     *
     *          @OA\JsonContent()
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="No email found",
     *
     *          @OA\JsonContent()
     *     )
     * )
     */
    public function sendMail(Request $request)
    {
        $email = $request->email;
        $findEmail = $this->userService->findUserByEmail($email);
        $token = Str::random(64);
        if ($findEmail) {
            $this->authService->createPasswordResset([
                'email' => $email,
                'token' => $token,
            ]);

            $findEmail->notify(new ResetPasswordNotification($token));

            return response([
                'message' => 'We have e-mailed your password reset link!',
            ]);
        } else {
            return response([
                'success' => false,
                'message' => 'No email found',
            ], 400);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/reset-password/{token}",
     *     operationId="resetPassword",
     *     tags={"Authentication"},
     *     summary="Reset password",
     *     description="Reset password.",
     *
     *      @OA\Parameter(
     *         name="token",
     *         in="path",
     *         required=true,
     *         description="token to reset password",
     *
     *         @OA\Schema(type="string"),
     *     ),
     *
     *     @OA\RequestBody(
     *
     *          @OA\JsonContent(),
     *         required=true,
     *
     *         @OA\MediaType(
     *            mediaType="multipart/form-data",
     *
     *            @OA\Schema(
     *               type="object",
     *               required={"password","password_confirmation"},
     *
     *               @OA\Property(property="password", type="password"),
     *               @OA\Property(property="password_confirmation", type="password"),
     *            ),
     *        ),
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="password has been successfully reset",
     *
     *          @OA\JsonContent()
     *     ),
     *
     *      @OA\Response(
     *         response=422,
     *         description="This password reset token is expire",
     *
     *          @OA\JsonContent()
     *     ),
     *
     *     @OA\Response(
     *         response=400,
     *         description="This password reset token is invalid.",
     *
     *          @OA\JsonContent()
     *     )
     * )
     */
    public function reset(ResetPasswordRequest $request, $token)
    {
        $findEmail = $this->authService->findResetPassword(['token' => $token]);

        if (isset($findEmail)) {
            $id = $this->userService->findUserByEmail($findEmail->email)->id;

            $timeDifference = now()->diffInMinutes($findEmail->updated_at);
            if ($timeDifference > 5) {
                $findEmail->delete();

                return response([
                    'message' => 'This password reset token is expire',
                ], 422);
            } else {
                // update new password
                $data['password'] = Hash::make($request->password);
                $this->userService->updateUser($id, $data);
                $findEmail->delete();

                return response([
                    'message' => 'password has been successfully reset',
                ], 200);
            }
        } else {
            return response([
                'message' => 'This password reset token is invalid.',
            ], 400);
        }
    }
}
