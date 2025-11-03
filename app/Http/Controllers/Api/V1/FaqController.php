<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Faq;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateFaqRequest;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Resources\FaqResource;
use App\Actions\Faq\StoreFaqAction;
use App\Actions\Faq\DeleteFaqAction;
use App\Actions\Faq\UpdateFaqAction;
use App\Repositories\Faq\FaqRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class FaqController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Faq::class);
    }

    /**
         * @OA\Get(
         *      path="/faq",
         *      operationId="getFaqs",
         *      tags={"Faq"},
         *      summary="get faqs list",
         *      description="Returns list of faqs",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/FaqResource")
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
    public function index(FaqRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            FaqResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/faq/{id}",
     *      operationId="getFaqById",
     *      tags={"Faq"},
     *      summary="Get faq information",
     *      description="Returns faq data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Faq id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/FaqResource")
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
    public function show(Faq $faq): JsonResponse
    {
        return Response::data(
            FaqResource::make($faq),
        );
    }

    /**
     * @OA\Post(
     *      path="/faq",
     *      operationId="storeFaq",
     *      tags={"Faq"},
     *      summary="Store new faq",
     *      description="Returns new faq data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreFaqRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/FaqResource")
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
    public function store(StoreFaqRequest $request): JsonResponse
    {
        $model = StoreFaqAction::run($request->validated());
        return Response::data(
            FaqResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('faq.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/faq/{id}",
     *      operationId="updateFaq",
     *      tags={"Faq"},
     *      summary="Update existing faq",
     *      description="Returns updated faq data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Faq id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateFaqRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/FaqResource")
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
     *          description="Faq Not Found"
     *      )
     * )
     */
    public function update(UpdateFaqRequest $request, Faq $faq): JsonResponse
    {
        $data = UpdateFaqAction::run($faq, $request->all());
        return Response::data(
            FaqResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('faq.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/faq/{id}",
     *      operationId="deleteFaq",
     *      tags={"Faq"},
     *      summary="Delete existing faq",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Faq id",
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
    public function destroy(Faq $faq): JsonResponse
    {
        DeleteFaqAction::run($faq);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('faq.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
