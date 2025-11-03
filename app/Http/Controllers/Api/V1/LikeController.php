<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Like;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateLikeRequest;
use App\Http\Requests\StoreLikeRequest;
use App\Http\Resources\LikeResource;
use App\Actions\Like\StoreLikeAction;
use App\Actions\Like\DeleteLikeAction;
use App\Actions\Like\UpdateLikeAction;
use App\Repositories\Like\LikeRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class LikeController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Like::class);
    }

    /**
         * @OA\Get(
         *      path="/like",
         *      operationId="getLikes",
         *      tags={"Like"},
         *      summary="get likes list",
         *      description="Returns list of likes",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/LikeResource")
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
    public function index(LikeRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            LikeResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/like/{id}",
     *      operationId="getLikeById",
     *      tags={"Like"},
     *      summary="Get like information",
     *      description="Returns like data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Like id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LikeResource")
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
    public function show(Like $like): JsonResponse
    {
        return Response::data(
            LikeResource::make($like),
        );
    }

    /**
     * @OA\Post(
     *      path="/like",
     *      operationId="storeLike",
     *      tags={"Like"},
     *      summary="Store new like",
     *      description="Returns new like data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLikeRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LikeResource")
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
    public function store(StoreLikeRequest $request): JsonResponse
    {
        $model = StoreLikeAction::run($request->validated());
        return Response::data(
            LikeResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('like.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/like/{id}",
     *      operationId="updateLike",
     *      tags={"Like"},
     *      summary="Update existing like",
     *      description="Returns updated like data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Like id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateLikeRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/LikeResource")
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
     *          description="Like Not Found"
     *      )
     * )
     */
    public function update(UpdateLikeRequest $request, Like $like): JsonResponse
    {
        $data = UpdateLikeAction::run($like, $request->all());
        return Response::data(
            LikeResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('like.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/like/{id}",
     *      operationId="deleteLike",
     *      tags={"Like"},
     *      summary="Delete existing like",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Like id",
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
    public function destroy(Like $like): JsonResponse
    {
        DeleteLikeAction::run($like);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('like.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
