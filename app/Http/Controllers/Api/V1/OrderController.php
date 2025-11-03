<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Order\StartTestPeriodAction;
use App\Http\Requests\StoreTestPeriodOrderRequest;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Resources\OrderResource;
use App\Actions\Order\StoreOrderAction;
use App\Actions\Order\DeleteOrderAction;
use App\Actions\Order\UpdateOrderAction;
use App\Repositories\Order\OrderRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class OrderController extends BaseApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Order::class);
    }
    
    /**
     * @OA\Get(
     *      path="/order",
     *      operationId="getOrders",
     *      tags={"Order"},
     *      summary="get orders list",
     *      description="Returns list of orders",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderResource")
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
    public function index(OrderRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            OrderResource::collection($repository->paginate())
        );
    }
    
    /**
     * @OA\Get(
     *      path="/order/{id}",
     *      operationId="getOrderById",
     *      tags={"Order"},
     *      summary="Get order information",
     *      description="Returns order data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Order id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderResource")
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
    public function show(Order $order): JsonResponse
    {
        return Response::data(
            OrderResource::make($order),
        );
    }
    
    /**
     * @OA\Post(
     *      path="/order",
     *      operationId="storeOrder",
     *      tags={"Order"},
     *      summary="Store new order",
     *      description="Returns new order data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreOrderRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderResource")
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
    public function store(StoreOrderRequest $request): JsonResponse
    {
        $model = StoreOrderAction::run($request->validated());
        return Response::data(
            OrderResource::make($model),
            trans('general.model_has_stored_successfully', ['model' => trans('order.model')]),
            Response::HTTP_CREATED
        );
    }
    
    /**
     * @OA\Put(
     *      path="/order/{id}",
     *      operationId="updateOrder",
     *      tags={"Order"},
     *      summary="Update existing order",
     *      description="Returns updated order data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Order id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateOrderRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/OrderResource")
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
     *          description="Order Not Found"
     *      )
     * )
     */
    public function update(UpdateOrderRequest $request, Order $order): JsonResponse
    {
        $data = UpdateOrderAction::run($order, $request->all());
        return Response::data(
            OrderResource::make($data),
            trans('general.model_has_updated_successfully', ['model' => trans('order.model')]),
            Response::HTTP_ACCEPTED
        );
    }
    
    /**
     * @OA\Delete(
     *      path="/order/{id}",
     *      operationId="deleteOrder",
     *      tags={"Order"},
     *      summary="Delete existing order",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Order id",
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
    public function destroy(Order $order): JsonResponse
    {
        DeleteOrderAction::run($order);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully', ['model' => trans('order.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
    
    /**
     * @OA\Post(
     *      path="/order/start-test-period",
     *      operationId="startTestPeriod",
     *      tags={"Order"},
     *      summary="enable test period from all service",
     *      description="every user can use one time in hole time",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreTestPeriodOrderRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent()
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
    public function startTestPeriod(StoreTestPeriodOrderRequest $request): JsonResponse
    {
        $result = StartTestPeriodAction::run($request->validated());
        return Response::data(
            $result,
            trans('order.start_test_period'),
            Response::HTTP_OK
        );
    }
}
