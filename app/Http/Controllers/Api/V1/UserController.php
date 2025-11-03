<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\User\DeleteUserAction;
use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class UserController extends BaseApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:sanctum');
//        $this->authorizeResource(User::class);
    }
    
    /**
     * @OA\Get(
     *      path="/user",
     *      operationId="getUsers",
     *      tags={"User"},
     *      summary="get users list",
     *      description="Returns list of users",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
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
    public function index(UserRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            UserResource::collection($repository->paginate())
        );
    }
    
    /**
     * @OA\Get(
     *      path="/user/{id}",
     *      operationId="getUserById",
     *      tags={"User"},
     *      summary="Get user information",
     *      description="Returns user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function show(User $user): JsonResponse
    {
        return Response::data(
            UserResource::make($user),
        );
    }
    
    /**
     * @OA\Post(
     *      path="/user",
     *      operationId="storeUser",
     *      tags={"User"},
     *      summary="Store new user",
     *      description="Returns new user data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $model = StoreUserAction::run($request->validated());
        return Response::data(
            UserResource::make($model),
            trans('general.model_has_stored_successfully', ['model' => trans('user.model')]),
            Response::HTTP_CREATED
        );
    }
    
    /**
     * @OA\Put(
     *      path="/user/{id}",
     *      operationId="updateUser",
     *      tags={"User"},
     *      summary="Update existing user",
     *      description="Returns updated user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="User Not Found"
     *      )
     * )
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = UpdateUserAction::run($user, $request->all());
        return Response::data(
            UserResource::make($data),
            trans('general.model_has_updated_successfully', ['model' => trans('user.model')]),
            Response::HTTP_ACCEPTED
        );
    }
    
    /**
     * @OA\Delete(
     *      path="/user/{id}",
     *      operationId="deleteUser",
     *      tags={"User"},
     *      summary="Delete existing user",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(User $user): JsonResponse
    {
        DeleteUserAction::run($user);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully', ['model' => trans('user.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
