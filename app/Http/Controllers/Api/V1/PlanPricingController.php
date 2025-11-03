<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\PlanPricing;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdatePlanPricingRequest;
use App\Http\Requests\StorePlanPricingRequest;
use App\Http\Resources\PlanPricingResource;
use App\Actions\PlanPricing\StorePlanPricingAction;
use App\Actions\PlanPricing\DeletePlanPricingAction;
use App\Actions\PlanPricing\UpdatePlanPricingAction;
use App\Repositories\PlanPricing\PlanPricingRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class PlanPricingController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(PlanPricing::class);
    }

    /**
         * @OA\Get(
         *      path="/plan-pricing",
         *      operationId="getPlanPricings",
         *      tags={"PlanPricing"},
         *      summary="get planPricings list",
         *      description="Returns list of planPricings",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/PlanPricingResource")
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
    public function index(PlanPricingRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            PlanPricingResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/plan-pricing/{id}",
     *      operationId="getPlanPricingById",
     *      tags={"PlanPricing"},
     *      summary="Get planPricing information",
     *      description="Returns planPricing data",
     *      @OA\Parameter(
     *          name="id",
     *          description="PlanPricing id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PlanPricingResource")
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
    public function show(PlanPricing $planPricing): JsonResponse
    {
        return Response::data(
            PlanPricingResource::make($planPricing),
        );
    }

    /**
     * @OA\Post(
     *      path="/plan-pricing",
     *      operationId="storePlanPricing",
     *      tags={"PlanPricing"},
     *      summary="Store new planPricing",
     *      description="Returns new planPricing data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePlanPricingRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PlanPricingResource")
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
    public function store(StorePlanPricingRequest $request): JsonResponse
    {
        $model = StorePlanPricingAction::run($request->validated());
        return Response::data(
            PlanPricingResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('planPricing.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/plan-pricing/{id}",
     *      operationId="updatePlanPricing",
     *      tags={"PlanPricing"},
     *      summary="Update existing planPricing",
     *      description="Returns updated planPricing data",
     *      @OA\Parameter(
     *          name="id",
     *          description="PlanPricing id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePlanPricingRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PlanPricingResource")
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
     *          description="PlanPricing Not Found"
     *      )
     * )
     */
    public function update(UpdatePlanPricingRequest $request, PlanPricing $planPricing): JsonResponse
    {
        $data = UpdatePlanPricingAction::run($planPricing, $request->all());
        return Response::data(
            PlanPricingResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('planPricing.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/plan-pricing/{id}",
     *      operationId="deletePlanPricing",
     *      tags={"PlanPricing"},
     *      summary="Delete existing planPricing",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="PlanPricing id",
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
    public function destroy(PlanPricing $planPricing): JsonResponse
    {
        DeletePlanPricingAction::run($planPricing);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('planPricing.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
