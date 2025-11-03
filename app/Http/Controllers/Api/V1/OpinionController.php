<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Opinion;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateOpinionRequest;
use App\Http\Requests\StoreOpinionRequest;
use App\Http\Resources\OpinionResource;
use App\Actions\Opinion\StoreOpinionAction;
use App\Actions\Opinion\DeleteOpinionAction;
use App\Actions\Opinion\UpdateOpinionAction;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class OpinionController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Opinion::class);
    }

    /**
         * @OA\Get(
         *      path="/opinion",
         *      operationId="getOpinions",
         *      tags={"Opinion"},
         *      summary="get opinions list",
         *      description="Returns list of opinions",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/OpinionResource")
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
    public function index(OpinionRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            OpinionResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/opinion/{id}",
     *      operationId="getOpinionById",
     *      tags={"Opinion"},
     *      summary="Get opinion information",
     *      description="Returns opinion data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Opinion id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OpinionResource")
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
    public function show(Opinion $opinion): JsonResponse
    {
        return Response::data(
            OpinionResource::make($opinion),
        );
    }

    /**
     * @OA\Post(
     *      path="/opinion",
     *      operationId="storeOpinion",
     *      tags={"Opinion"},
     *      summary="Store new opinion",
     *      description="Returns new opinion data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreOpinionRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OpinionResource")
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
    public function store(StoreOpinionRequest $request): JsonResponse
    {
        $model = StoreOpinionAction::run($request->validated());
        return Response::data(
            OpinionResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('opinion.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/opinion/{id}",
     *      operationId="updateOpinion",
     *      tags={"Opinion"},
     *      summary="Update existing opinion",
     *      description="Returns updated opinion data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Opinion id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateOpinionRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OpinionResource")
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
     *          description="Opinion Not Found"
     *      )
     * )
     */
    public function update(UpdateOpinionRequest $request, Opinion $opinion): JsonResponse
    {
        $data = UpdateOpinionAction::run($opinion, $request->all());
        return Response::data(
            OpinionResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('opinion.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/opinion/{id}",
     *      operationId="deleteOpinion",
     *      tags={"Opinion"},
     *      summary="Delete existing opinion",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Opinion id",
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
    public function destroy(Opinion $opinion): JsonResponse
    {
        DeleteOpinionAction::run($opinion);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('opinion.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
