<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ReportReason;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateReportReasonRequest;
use App\Http\Requests\StoreReportReasonRequest;
use App\Http\Resources\ReportReasonResource;
use App\Actions\ReportReason\StoreReportReasonAction;
use App\Actions\ReportReason\DeleteReportReasonAction;
use App\Actions\ReportReason\UpdateReportReasonAction;
use App\Repositories\ReportReason\ReportReasonRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ReportReasonController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(ReportReason::class);
    }

    /**
         * @OA\Get(
         *      path="/report-reason",
         *      operationId="getReportReasons",
         *      tags={"ReportReason"},
         *      summary="get reportReasons list",
         *      description="Returns list of reportReasons",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ReportReasonResource")
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
    public function index(ReportReasonRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ReportReasonResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/report-reason/{id}",
     *      operationId="getReportReasonById",
     *      tags={"ReportReason"},
     *      summary="Get reportReason information",
     *      description="Returns reportReason data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ReportReason id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ReportReasonResource")
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
    public function show(ReportReason $reportReason): JsonResponse
    {
        return Response::data(
            ReportReasonResource::make($reportReason),
        );
    }

    /**
     * @OA\Post(
     *      path="/report-reason",
     *      operationId="storeReportReason",
     *      tags={"ReportReason"},
     *      summary="Store new reportReason",
     *      description="Returns new reportReason data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreReportReasonRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ReportReasonResource")
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
    public function store(StoreReportReasonRequest $request): JsonResponse
    {
        $model = StoreReportReasonAction::run($request->validated());
        return Response::data(
            ReportReasonResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('reportReason.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/report-reason/{id}",
     *      operationId="updateReportReason",
     *      tags={"ReportReason"},
     *      summary="Update existing reportReason",
     *      description="Returns updated reportReason data",
     *      @OA\Parameter(
     *          name="id",
     *          description="ReportReason id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateReportReasonRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ReportReasonResource")
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
     *          description="ReportReason Not Found"
     *      )
     * )
     */
    public function update(UpdateReportReasonRequest $request, ReportReason $reportReason): JsonResponse
    {
        $data = UpdateReportReasonAction::run($reportReason, $request->all());
        return Response::data(
            ReportReasonResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('reportReason.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/report-reason/{id}",
     *      operationId="deleteReportReason",
     *      tags={"ReportReason"},
     *      summary="Delete existing reportReason",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="ReportReason id",
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
    public function destroy(ReportReason $reportReason): JsonResponse
    {
        DeleteReportReasonAction::run($reportReason);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('reportReason.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
