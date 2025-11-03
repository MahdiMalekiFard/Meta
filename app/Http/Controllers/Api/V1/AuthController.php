<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\SendSmsCodeAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\ConfirmRequest;
use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\SetPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use OpenApi\Annotations as OA;

class AuthController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->only('logout', 'setPassword','me');
    }
    
    /**
     * @OA\Post(
     *      path="/register",
     *      operationId="register",
     *      tags={"Auth"},
     *      summary="Register new user",
     *      description="Returns new user data",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/RegisterRequest")
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User registered successfully"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  ref="#/components/schemas/UserResource"
     *              )
     *          )
     *      ),
     *
     *          @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="error",
     *                   type="string",
     *                   example="Invalid input data"
     *               )
     *           )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="error",
     *                  type="string",
     *                  example="Unauthenticated"
     *              )
     *           )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *          @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="error",
     *                   type="string",
     *                   example="Forbidden"
     *               )
     *           )
     *      )
     * )
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        $user = StoreUserAction::run($request->validated());
        SendSmsCodeAction::run($user);
        return Response::data($user);
    }
    
    /**
     * @OA\Post(
     *      path="/confirm",
     *      operationId="confirm",
     *      tags={"Auth"},
     *      summary="Confirm new user",
     *      description="Returns new user data",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ConfirmRequest")
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User registered successfully"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                       property="token",
     *                       type="string",
     *                       example="some-jwt-token"
     *                   ),
     *                   @OA\Property(
     *                       property="user",
     *                       ref="#/components/schemas/UserResource"
     *                   )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      )
     * )
     */
    public function confirm(ConfirmRequest $request, ActivationCodeRepositoryInterface $repository, UserRepositoryInterface $userRepository): JsonResponse
    {
        $user = $userRepository->find($request->input('email'), 'email', firstOrFail: true);
        $activationCode = $repository->checkCode($user, $request->input('code'));
        if (!$activationCode) {
            return Response::error(trans('authentication.please_enter_validation_code'), 404);
        }
        $repository->useCode($activationCode);
        if (is_null($user->profile->email_verify_at)) {
            $userRepository->verifyUserEmailAddress($user);
        }
        
        $token = $userRepository->generateToken($user);
        return Response::data([
            'token' => $token,
            'user'  => UserResource::make($user),
        ]);
    }
    
    /**
     * @OA\Post(
     *      path="/set-password",
     *      operationId="setPassword",
     *      tags={"Auth"},
     *      summary="Set user password",
     *      description="Returns user data",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/SetPasswordRequest")
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User authenticated successfully"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/UserResource"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      )
     * )
     */
    public function setPassword(SetPasswordRequest $request): JsonResponse
    {
        $user = auth()->user();
        if (!$user) {
            return Response::error(trans('authentication.Failed_to_update_user'));
        }
        $data = $request->validated();
        $data['password'] = Hash::make($request->input('password'));
        $user = UpdateUserAction::run($user, $data);
        
        return Response::data([
            'user' => UserResource::make($user),
        ], trans('authentication.Password_registered_successfully'));
    }
    
    /**
     * @OA\Post(
     *      path="/login",
     *      operationId="login",
     *      tags={"Auth"},
     *      summary="Login user",
     *      description="Returns user data",
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/LoginRequest")
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User authenticated successfully"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/UserResource"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      )
     * )
     */
    public function login(LoginRequest $request, UserRepositoryInterface $userRepository): JsonResponse
    {
        $credentials = $request->only('email', 'password');
        $user = $userRepository->find(value: $request->input('email'), field: 'email', firstOrFail: true);
        if (is_null($user->profile->email_verify_at)){
            SendSmsCodeAction::run($user);
            return Response::error(trans('authentication.you_not_verify_email_address_we_send_new_verification_code_to_your_email'), 400);
        }
        if (!empty($user->password) && Auth::guard('web')->attempt($credentials)) {
            $token = $userRepository->generateToken($user);
            return Response::data([
                'token' => $token,
                'user'  => UserResource::make($user),
            ], trans('authentication.user_authenticated_successfully'));
        }
        return Response::error(trans('authentication.mobile_or_password_not_match'), 404);
    }
    
    /**
     * @OA\Post(
     *      path="/forget-password",
     *      operationId="forgetPassword",
     *      tags={"Auth"},
     *
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ForgetPasswordRequest")
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="Verification code has been successfully sent"
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request",
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden",
     *      )
     * )
     */
    public function forgetPassword(ForgetPasswordRequest $request, UserRepositoryInterface $repository): ?JsonResponse
    {
        /** @var User $user */
        $user = $repository->find(value: $request->input('email'), field: 'email', firstOrFail: true);
        SendSmsCodeAction::run($user);
        return Response::data('', trans('authentication.verification_code_has_been_successfully_sent'));
    }
    
    /**
     * @OA\Get(
     *      path="/logout",
     *      operationId="logout",
     *      tags={"Auth"},
     *      summary="Logout user",
     *      description="Returns user data",
     *      @OA\Response(
     *          response=200,
     *           description="Successful operation",
     *           @OA\JsonContent(
     *               type="object",
     *               @OA\Property(
     *                   property="message",
     *                   type="string",
     *                   example="You have successfully logged out"
     *               ),
     *           )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function logout(): JsonResponse
    {
        if (auth()->check()) {
            Auth::user()?->tokens()->delete();
            return Response::data('', trans('authentication.You_have_successfully_logged_out'));
        }
        return Response::error(trans('authentication.No_authenticated_user_detected'), 401);
    }
    
    
    /**
     * @OA\Get(
     *      path="/me",
     *      operationId="me",
     *      tags={"Auth"},
     *      summary="Get user data",
     *      description="Returns user data",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User data retrieved successfully"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  ref="#/components/schemas/UserResource"
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function me(): JsonResponse
    {
        return Response::data(UserResource::make(auth()->user()));
    }
}