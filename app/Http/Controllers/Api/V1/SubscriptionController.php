<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Subscription;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateSubscriptionRequest;
use App\Http\Requests\StoreSubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Actions\Subscription\StoreSubscriptionAction;
use App\Actions\Subscription\DeleteSubscriptionAction;
use App\Actions\Subscription\UpdateSubscriptionAction;
use App\Repositories\Subscription\SubscriptionRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class SubscriptionController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Subscription::class);
    }

    /**
         * @OA\Get(
         *      path="/subscription",
         *      operationId="getSubscriptions",
         *      tags={"Subscription"},
         *      summary="get subscriptions list",
         *      description="Returns list of subscriptions",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/SubscriptionResource")
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
    public function index(SubscriptionRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            SubscriptionResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/subscription/{id}",
     *      operationId="getSubscriptionById",
     *      tags={"Subscription"},
     *      summary="Get subscription information",
     *      description="Returns subscription data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Subscription id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SubscriptionResource")
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
    public function show(Subscription $subscription): JsonResponse
    {
        return Response::data(
            SubscriptionResource::make($subscription),
        );
    }

    /**
     * @OA\Post(
     *      path="/subscription",
     *      operationId="storeSubscription",
     *      tags={"Subscription"},
     *      summary="Store new subscription",
     *      description="Returns new subscription data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSubscriptionRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SubscriptionResource")
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
    public function store(StoreSubscriptionRequest $request): JsonResponse
    {
        $model = StoreSubscriptionAction::run($request->validated());
        return Response::data(
            SubscriptionResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('subscription.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/subscription/{id}",
     *      operationId="updateSubscription",
     *      tags={"Subscription"},
     *      summary="Update existing subscription",
     *      description="Returns updated subscription data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Subscription id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateSubscriptionRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/SubscriptionResource")
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
     *          description="Subscription Not Found"
     *      )
     * )
     */
    public function update(UpdateSubscriptionRequest $request, Subscription $subscription): JsonResponse
    {
        $data = UpdateSubscriptionAction::run($subscription, $request->all());
        return Response::data(
            SubscriptionResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('subscription.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/subscription/{id}",
     *      operationId="deleteSubscription",
     *      tags={"Subscription"},
     *      summary="Delete existing subscription",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Subscription id",
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
    public function destroy(Subscription $subscription): JsonResponse
    {
        DeleteSubscriptionAction::run($subscription);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('subscription.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
