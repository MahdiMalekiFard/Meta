<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateOrderItemRequest;
use App\Http\Requests\StoreOrderItemRequest;
use App\Http\Resources\OrderItemResource;
use App\Actions\OrderItem\StoreOrderItemAction;
use App\Actions\OrderItem\DeleteOrderItemAction;
use App\Actions\OrderItem\UpdateOrderItemAction;
use App\Repositories\OrderItem\OrderItemRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class OrderItemController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(OrderItem::class);
    }

    /**
         * @OA\Get(
         *      path="/order-item",
         *      operationId="getOrderItems",
         *      tags={"OrderItem"},
         *      summary="get orderItems list",
         *      description="Returns list of orderItems",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/OrderItemResource")
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
    public function index(OrderItemRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            OrderItemResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/order-item/{id}",
     *      operationId="getOrderItemById",
     *      tags={"OrderItem"},
     *      summary="Get orderItem information",
     *      description="Returns orderItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrderItem id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderItemResource")
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
    public function show(OrderItem $orderItem): JsonResponse
    {
        return Response::data(
            OrderItemResource::make($orderItem),
        );
    }

    /**
     * @OA\Post(
     *      path="/order-item",
     *      operationId="storeOrderItem",
     *      tags={"OrderItem"},
     *      summary="Store new orderItem",
     *      description="Returns new orderItem data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreOrderItemRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderItemResource")
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
    public function store(StoreOrderItemRequest $request): JsonResponse
    {
        $model = StoreOrderItemAction::run($request->validated());
        return Response::data(
            OrderItemResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('orderItem.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/order-item/{id}",
     *      operationId="updateOrderItem",
     *      tags={"OrderItem"},
     *      summary="Update existing orderItem",
     *      description="Returns updated orderItem data",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrderItem id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateOrderItemRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderItemResource")
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
     *          description="OrderItem Not Found"
     *      )
     * )
     */
    public function update(UpdateOrderItemRequest $request, OrderItem $orderItem): JsonResponse
    {
        $data = UpdateOrderItemAction::run($orderItem, $request->all());
        return Response::data(
            OrderItemResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('orderItem.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/order-item/{id}",
     *      operationId="deleteOrderItem",
     *      tags={"OrderItem"},
     *      summary="Delete existing orderItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="OrderItem id",
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
    public function destroy(OrderItem $orderItem): JsonResponse
    {
        DeleteOrderItemAction::run($orderItem);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('orderItem.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
