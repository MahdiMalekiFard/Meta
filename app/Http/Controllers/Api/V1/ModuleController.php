<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Module;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateModuleRequest;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Actions\Module\StoreModuleAction;
use App\Actions\Module\DeleteModuleAction;
use App\Actions\Module\UpdateModuleAction;
use App\Repositories\Module\ModuleRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ModuleController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Module::class);
    }

    /**
         * @OA\Get(
         *      path="/module",
         *      operationId="getModules",
         *      tags={"Module"},
         *      summary="get modules list",
         *      description="Returns list of modules",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ModuleResource")
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
    public function index(ModuleRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ModuleResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/module/{id}",
     *      operationId="getModuleById",
     *      tags={"Module"},
     *      summary="Get module information",
     *      description="Returns module data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Module id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ModuleResource")
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
    public function show(Module $module): JsonResponse
    {
        return Response::data(
            ModuleResource::make($module),
        );
    }

    /**
     * @OA\Post(
     *      path="/module",
     *      operationId="storeModule",
     *      tags={"Module"},
     *      summary="Store new module",
     *      description="Returns new module data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreModuleRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ModuleResource")
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
    public function store(StoreModuleRequest $request): JsonResponse
    {
        $model = StoreModuleAction::run($request->validated());
        return Response::data(
            ModuleResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('module.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/module/{id}",
     *      operationId="updateModule",
     *      tags={"Module"},
     *      summary="Update existing module",
     *      description="Returns updated module data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Module id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateModuleRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ModuleResource")
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
     *          description="Module Not Found"
     *      )
     * )
     */
    public function update(UpdateModuleRequest $request, Module $module): JsonResponse
    {
        $data = UpdateModuleAction::run($module, $request->all());
        return Response::data(
            ModuleResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('module.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/module/{id}",
     *      operationId="deleteModule",
     *      tags={"Module"},
     *      summary="Delete existing module",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Module id",
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
    public function destroy(Module $module): JsonResponse
    {
        DeleteModuleAction::run($module);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('module.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
