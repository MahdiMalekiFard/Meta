<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Resources\ServerResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\TicketResource;
use App\Models\Server;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class DashboardController extends BaseApiController
{
    
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    
    /**
     * @OA\Get(
     *      path="/dashboard/",
     *      operationId="dashboardIndex",
     *      tags={"Dashboard"},
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(
     *              type="object",
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="User data retrieved successfully"
     *              ),
     *              @OA\Property(
     *                  property="data",
     *                  type="object",
     *                  @OA\Property(
     *                        property="tickets",
     *                        type="array",
     *                        @OA\Items(ref="#/components/schemas/TicketResource")
     *                  ),
     *                  @OA\Property(
     *                      property="services",
     *                      type="array",
     *                      @OA\Items(ref="#/components/schemas/ServiceResource")
     *                  )
     *              )
     *          )
     *      ),
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
    public function index(): JsonResponse
    {
        return Response::data([
            'server'   => auth()->user()->server ? ServerResource::make(auth()->user()->server) : null,
            'services' => ServiceResource::collection(auth()->user()->services()->with('media')->get()),
            'tickets'  => TicketResource::collection(auth()->user()->tickets()->with('user', 'lastMessage', 'lastMessage.media')->limit(5)->get()),
        ]);
    }
    
}