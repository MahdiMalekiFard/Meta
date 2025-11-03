<?php

namespace App\Http\Controllers\Api\V1;

use App\Actions\Banner\DeleteBannerAction;
use App\Actions\Banner\StoreBannerAction;
use App\Actions\Banner\UpdateBannerAction;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Repositories\Banner\BannerRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class BannerController extends BaseApiController
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Banner::class);
    }

    /**
     * @OA\Get(
     *      path="/banner",
     *      operationId="getBanners",
     *      tags={"Banner"},
     *      summary="get banners list",
     *      description="Returns list of banners",
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(ref="#/components/schemas/BannerResource")
     *       ),
     *
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
    public function index(BannerRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            BannerResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/banner/{id}",
     *      operationId="getBannerById",
     *      tags={"Banner"},
     *      summary="Get banner information",
     *      description="Returns banner data",
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Banner id",
     *          required=true,
     *          in="path",
     *
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(ref="#/components/schemas/BannerResource")
     *       ),
     *
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
    public function show(Banner $banner): JsonResponse
    {
        return Response::data(
            BannerResource::make($banner),
        );
    }

    /**
     * @OA\Post(
     *      path="/banner",
     *      operationId="storeBanner",
     *      tags={"Banner"},
     *      summary="Store new banner",
     *      description="Returns new banner data",
     *
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(ref="#/components/schemas/StoreBannerRequest")
     *      ),
     *
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(ref="#/components/schemas/BannerResource")
     *       ),
     *
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
    public function store(StoreBannerRequest $request): JsonResponse
    {
        $model = StoreBannerAction::run($request->validated());

        return Response::data(
            BannerResource::make($model),
            trans('general.model_has_stored_successfully', ['model' => trans('banner.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/banner/{id}",
     *      operationId="updateBanner",
     *      tags={"Banner"},
     *      summary="Update existing banner",
     *      description="Returns updated banner data",
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Banner id",
     *          required=true,
     *          in="path",
     *
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\RequestBody(
     *          required=true,
     *
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBannerRequest")
     *      ),
     *
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *
     *          @OA\JsonContent(ref="#/components/schemas/BannerResource")
     *       ),
     *
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
     *          description="Banner Not Found"
     *      )
     * )
     */
    public function update(UpdateBannerRequest $request, Banner $banner): JsonResponse
    {
        $data = UpdateBannerAction::run($banner, $request->all());

        return Response::data(
            BannerResource::make($data),
            trans('general.model_has_updated_successfully', ['model' => trans('banner.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/banner/{id}",
     *      operationId="deleteBanner",
     *      tags={"Banner"},
     *      summary="Delete existing banner",
     *      description="Deletes a record and returns no content",
     *
     *      @OA\Parameter(
     *          name="id",
     *          description="Banner id",
     *          required=true,
     *          in="path",
     *
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *
     *          @OA\JsonContent()
     *       ),
     *
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
    public function destroy(Banner $banner): JsonResponse
    {
        DeleteBannerAction::run($banner);

        return Response::data(
            true,
            trans('general.model_has_deleted_successfully', ['model' => trans('banner.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
