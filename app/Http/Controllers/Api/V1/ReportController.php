<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Report;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Requests\StoreReportRequest;
use App\Http\Resources\ReportResource;
use App\Actions\Report\StoreReportAction;
use App\Actions\Report\DeleteReportAction;
use App\Actions\Report\UpdateReportAction;
use App\Repositories\Report\ReportRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ReportController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Report::class);
    }

    /**
         * @OA\Get(
         *      path="/report",
         *      operationId="getReports",
         *      tags={"Report"},
         *      summary="get reports list",
         *      description="Returns list of reports",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/ReportResource")
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
    public function index(ReportRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ReportResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/report/{id}",
     *      operationId="getReportById",
     *      tags={"Report"},
     *      summary="Get report information",
     *      description="Returns report data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Report id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ReportResource")
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
    public function show(Report $report): JsonResponse
    {
        return Response::data(
            ReportResource::make($report),
        );
    }

    /**
     * @OA\Post(
     *      path="/report",
     *      operationId="storeReport",
     *      tags={"Report"},
     *      summary="Store new report",
     *      description="Returns new report data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreReportRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ReportResource")
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
    public function store(StoreReportRequest $request): JsonResponse
    {
        $model = StoreReportAction::run($request->validated());
        return Response::data(
            ReportResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('report.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/report/{id}",
     *      operationId="updateReport",
     *      tags={"Report"},
     *      summary="Update existing report",
     *      description="Returns updated report data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Report id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateReportRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/ReportResource")
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
     *          description="Report Not Found"
     *      )
     * )
     */
    public function update(UpdateReportRequest $request, Report $report): JsonResponse
    {
        $data = UpdateReportAction::run($report, $request->all());
        return Response::data(
            ReportResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('report.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/report/{id}",
     *      operationId="deleteReport",
     *      tags={"Report"},
     *      summary="Delete existing report",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Report id",
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
    public function destroy(Report $report): JsonResponse
    {
        DeleteReportAction::run($report);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('report.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
