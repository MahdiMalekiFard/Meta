<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Service;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateServiceRequest;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Resources\ServiceResource;
use App\Actions\Service\StoreServiceAction;
use App\Actions\Service\DeleteServiceAction;
use App\Actions\Service\UpdateServiceAction;
use App\Repositories\Service\ServiceRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ServiceController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Service::class);
    }

    /**
         * @OA\Get(
         *      path="/service",
         *      operationId="getServices",
         *      tags={"Service"},
         *      summary="get services list",
         *      description="Returns list of services",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ServiceResource")
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
    public function index(ServiceRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ServiceResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/service/{id}",
     *      operationId="getServiceById",
     *      tags={"Service"},
     *      summary="Get service information",
     *      description="Returns service data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Service id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ServiceResource")
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
    public function show(Service $service): JsonResponse
    {
        return Response::data(
            ServiceResource::make($service),
        );
    }

    /**
     * @OA\Post(
     *      path="/service",
     *      operationId="storeService",
     *      tags={"Service"},
     *      summary="Store new service",
     *      description="Returns new service data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreServiceRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ServiceResource")
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
    public function store(StoreServiceRequest $request): JsonResponse
    {
        $model = StoreServiceAction::run($request->validated());
        return Response::data(
            ServiceResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('service.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/service/{id}",
     *      operationId="updateService",
     *      tags={"Service"},
     *      summary="Update existing service",
     *      description="Returns updated service data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Service id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateServiceRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ServiceResource")
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
     *          description="Service Not Found"
     *      )
     * )
     */
    public function update(UpdateServiceRequest $request, Service $service): JsonResponse
    {
        $data = UpdateServiceAction::run($service, $request->all());
        return Response::data(
            ServiceResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('service.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/service/{id}",
     *      operationId="deleteService",
     *      tags={"Service"},
     *      summary="Delete existing service",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Service id",
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
    public function destroy(Service $service): JsonResponse
    {
        DeleteServiceAction::run($service);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('service.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
