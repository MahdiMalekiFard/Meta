<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Notice;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateNoticeRequest;
use App\Http\Requests\StoreNoticeRequest;
use App\Http\Resources\NoticeResource;
use App\Actions\Notice\StoreNoticeAction;
use App\Actions\Notice\DeleteNoticeAction;
use App\Actions\Notice\UpdateNoticeAction;
use App\Repositories\Notice\NoticeRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class NoticeController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Notice::class);
    }

    /**
         * @OA\Get(
         *      path="/notice",
         *      operationId="getNotices",
         *      tags={"Notice"},
         *      summary="get notices list",
         *      description="Returns list of notices",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/NoticeResource")
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
    public function index(NoticeRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            NoticeResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/notice/{id}",
     *      operationId="getNoticeById",
     *      tags={"Notice"},
     *      summary="Get notice information",
     *      description="Returns notice data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Notice id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/NoticeResource")
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
    public function show(Notice $notice): JsonResponse
    {
        return Response::data(
            NoticeResource::make($notice),
        );
    }

    /**
     * @OA\Post(
     *      path="/notice",
     *      operationId="storeNotice",
     *      tags={"Notice"},
     *      summary="Store new notice",
     *      description="Returns new notice data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreNoticeRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/NoticeResource")
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
    public function store(StoreNoticeRequest $request): JsonResponse
    {
        $model = StoreNoticeAction::run($request->validated());
        return Response::data(
            NoticeResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('notice.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/notice/{id}",
     *      operationId="updateNotice",
     *      tags={"Notice"},
     *      summary="Update existing notice",
     *      description="Returns updated notice data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Notice id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateNoticeRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/NoticeResource")
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
     *          description="Notice Not Found"
     *      )
     * )
     */
    public function update(UpdateNoticeRequest $request, Notice $notice): JsonResponse
    {
        $data = UpdateNoticeAction::run($notice, $request->all());
        return Response::data(
            NoticeResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('notice.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/notice/{id}",
     *      operationId="deleteNotice",
     *      tags={"Notice"},
     *      summary="Delete existing notice",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Notice id",
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
    public function destroy(Notice $notice): JsonResponse
    {
        DeleteNoticeAction::run($notice);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('notice.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
