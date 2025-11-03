<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Actions\Profile\StoreProfileAction;
use App\Actions\Profile\DeleteProfileAction;
use App\Actions\Profile\UpdateProfileAction;
use App\Repositories\Profile\ProfileRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ProfileController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Profile::class);
    }

    /**
         * @OA\Get(
         *      path="/profile",
         *      operationId="getProfiles",
         *      tags={"Profile"},
         *      summary="get profiles list",
         *      description="Returns list of profiles",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ProfileResource")
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
    public function index(ProfileRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ProfileResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/profile/{id}",
     *      operationId="getProfileById",
     *      tags={"Profile"},
     *      summary="Get profile information",
     *      description="Returns profile data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Profile id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProfileResource")
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
    public function show(Profile $profile): JsonResponse
    {
        return Response::data(
            ProfileResource::make($profile),
        );
    }

    /**
     * @OA\Post(
     *      path="/profile",
     *      operationId="storeProfile",
     *      tags={"Profile"},
     *      summary="Store new profile",
     *      description="Returns new profile data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProfileRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProfileResource")
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
    public function store(StoreProfileRequest $request): JsonResponse
    {
        $model = StoreProfileAction::run($request->validated());
        return Response::data(
            ProfileResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('profile.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/profile/{id}",
     *      operationId="updateProfile",
     *      tags={"Profile"},
     *      summary="Update existing profile",
     *      description="Returns updated profile data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Profile id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateProfileRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ProfileResource")
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
     *          description="Profile Not Found"
     *      )
     * )
     */
    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        $data = UpdateProfileAction::run($profile, $request->all());
        return Response::data(
            ProfileResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('profile.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/profile/{id}",
     *      operationId="deleteProfile",
     *      tags={"Profile"},
     *      summary="Delete existing profile",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Profile id",
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
    public function destroy(Profile $profile): JsonResponse
    {
        DeleteProfileAction::run($profile);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('profile.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
