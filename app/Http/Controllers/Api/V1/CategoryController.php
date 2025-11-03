<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Actions\Category\StoreCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CategoryController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Category::class);
    }

    /**
         * @OA\Get(
         *      path="/category",
         *      operationId="getCategorys",
         *      tags={"Category"},
         *      summary="get categorys list",
         *      description="Returns list of categorys",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
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
    public function index(CategoryRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CategoryResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/category/{id}",
     *      operationId="getCategoryById",
     *      tags={"Category"},
     *      summary="Get category information",
     *      description="Returns category data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
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
    public function show(Category $category): JsonResponse
    {
        return Response::data(
            CategoryResource::make($category),
        );
    }

    /**
     * @OA\Post(
     *      path="/category",
     *      operationId="storeCategory",
     *      tags={"Category"},
     *      summary="Store new category",
     *      description="Returns new category data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCategoryRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
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
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $model = StoreCategoryAction::run($request->validated());
        return Response::data(
            CategoryResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('category.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/category/{id}",
     *      operationId="updateCategory",
     *      tags={"Category"},
     *      summary="Update existing category",
     *      description="Returns updated category data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCategoryRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CategoryResource")
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
     *          description="Category Not Found"
     *      )
     * )
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $data = UpdateCategoryAction::run($category, $request->all());
        return Response::data(
            CategoryResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('category.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/category/{id}",
     *      operationId="deleteCategory",
     *      tags={"Category"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Category id",
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
    public function destroy(Category $category): JsonResponse
    {
        DeleteCategoryAction::run($category);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('category.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
