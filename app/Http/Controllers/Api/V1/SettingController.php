<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Resources\SettingResource;
use App\Actions\Setting\StoreSettingAction;
use App\Actions\Setting\DeleteSettingAction;
use App\Actions\Setting\UpdateSettingAction;
use App\Repositories\Setting\SettingRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class SettingController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Setting::class);
    }

    /**
         * @OA\Get(
         *      path="/setting",
         *      operationId="getSettings",
         *      tags={"Setting"},
         *      summary="get settings list",
         *      description="Returns list of settings",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/SettingResource")
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
    public function index(SettingRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            SettingResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/setting/{id}",
     *      operationId="getSettingById",
     *      tags={"Setting"},
     *      summary="Get setting information",
     *      description="Returns setting data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Setting id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SettingResource")
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
    public function show(Setting $setting): JsonResponse
    {
        return Response::data(
            SettingResource::make($setting),
        );
    }

    /**
     * @OA\Post(
     *      path="/setting",
     *      operationId="storeSetting",
     *      tags={"Setting"},
     *      summary="Store new setting",
     *      description="Returns new setting data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSettingRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SettingResource")
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
    public function store(StoreSettingRequest $request): JsonResponse
    {
        $model = StoreSettingAction::run($request->validated());
        return Response::data(
            SettingResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('setting.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/setting/{id}",
     *      operationId="updateSetting",
     *      tags={"Setting"},
     *      summary="Update existing setting",
     *      description="Returns updated setting data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Setting id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateSettingRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SettingResource")
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
     *          description="Setting Not Found"
     *      )
     * )
     */
    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $data = UpdateSettingAction::run($setting, $request->all());
        return Response::data(
            SettingResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('setting.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/setting/{id}",
     *      operationId="deleteSetting",
     *      tags={"Setting"},
     *      summary="Delete existing setting",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Setting id",
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
    public function destroy(Setting $setting): JsonResponse
    {
        DeleteSettingAction::run($setting);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('setting.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
