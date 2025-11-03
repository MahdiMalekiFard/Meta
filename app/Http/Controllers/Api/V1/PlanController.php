<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Plan;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdatePlanRequest;
use App\Http\Requests\StorePlanRequest;
use App\Http\Resources\PlanResource;
use App\Actions\Plan\StorePlanAction;
use App\Actions\Plan\DeletePlanAction;
use App\Actions\Plan\UpdatePlanAction;
use App\Repositories\Plan\PlanRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class PlanController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Plan::class);
    }

    /**
         * @OA\Get(
         *      path="/plan",
         *      operationId="getPlans",
         *      tags={"Plan"},
         *      summary="get plans list",
         *      description="Returns list of plans",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/PlanResource")
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
    public function index(PlanRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            PlanResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/plan/{id}",
     *      operationId="getPlanById",
     *      tags={"Plan"},
     *      summary="Get plan information",
     *      description="Returns plan data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Plan id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PlanResource")
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
    public function show(Plan $plan): JsonResponse
    {
        return Response::data(
            PlanResource::make($plan),
        );
    }

    /**
     * @OA\Post(
     *      path="/plan",
     *      operationId="storePlan",
     *      tags={"Plan"},
     *      summary="Store new plan",
     *      description="Returns new plan data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePlanRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PlanResource")
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
    public function store(StorePlanRequest $request): JsonResponse
    {
        $model = StorePlanAction::run($request->validated());
        return Response::data(
            PlanResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('plan.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/plan/{id}",
     *      operationId="updatePlan",
     *      tags={"Plan"},
     *      summary="Update existing plan",
     *      description="Returns updated plan data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Plan id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePlanRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/PlanResource")
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
     *          description="Plan Not Found"
     *      )
     * )
     */
    public function update(UpdatePlanRequest $request, Plan $plan): JsonResponse
    {
        $data = UpdatePlanAction::run($plan, $request->all());
        return Response::data(
            PlanResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('plan.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/plan/{id}",
     *      operationId="deletePlan",
     *      tags={"Plan"},
     *      summary="Delete existing plan",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Plan id",
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
    public function destroy(Plan $plan): JsonResponse
    {
        DeletePlanAction::run($plan);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('plan.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
