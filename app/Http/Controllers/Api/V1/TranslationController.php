<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Translation;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateTranslationRequest;
use App\Http\Requests\StoreTranslationRequest;
use App\Http\Resources\TranslationResource;
use App\Actions\Translation\SyncTranslationAction;
use App\Actions\Translation\DeleteTranslationAction;
use App\Actions\Translation\UpdateTranslationAction;
use App\Repositories\Translation\TranslationRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class TranslationController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Translation::class);
    }

    /**
         * @OA\Get(
         *      path="/translation",
         *      operationId="getTranslations",
         *      tags={"Translation"},
         *      summary="get translations list",
         *      description="Returns list of translations",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/TranslationResource")
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
    public function index(TranslationRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            TranslationResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/translation/{id}",
     *      operationId="getTranslationById",
     *      tags={"Translation"},
     *      summary="Get translation information",
     *      description="Returns translation data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Translation id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TranslationResource")
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
    public function show(Translation $translation): JsonResponse
    {
        return Response::data(
            TranslationResource::make($translation),
        );
    }

    /**
     * @OA\Post(
     *      path="/translation",
     *      operationId="storeTranslation",
     *      tags={"Translation"},
     *      summary="Store new translation",
     *      description="Returns new translation data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreTranslationRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TranslationResource")
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
    public function store(StoreTranslationRequest $request): JsonResponse
    {
        $model = SyncTranslationAction::run($request->validated());
        return Response::data(
            TranslationResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('translation.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/translation/{id}",
     *      operationId="updateTranslation",
     *      tags={"Translation"},
     *      summary="Update existing translation",
     *      description="Returns updated translation data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Translation id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateTranslationRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/TranslationResource")
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
     *          description="Translation Not Found"
     *      )
     * )
     */
    public function update(UpdateTranslationRequest $request, Translation $translation): JsonResponse
    {
        $data = UpdateTranslationAction::run($translation, $request->all());
        return Response::data(
            TranslationResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('translation.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/translation/{id}",
     *      operationId="deleteTranslation",
     *      tags={"Translation"},
     *      summary="Delete existing translation",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Translation id",
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
    public function destroy(Translation $translation): JsonResponse
    {
        DeleteTranslationAction::run($translation);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('translation.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
