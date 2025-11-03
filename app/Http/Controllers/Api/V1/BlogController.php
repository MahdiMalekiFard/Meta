<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Resources\BlogResource;
use App\Actions\Blog\StoreBlogAction;
use App\Actions\Blog\DeleteBlogAction;
use App\Actions\Blog\UpdateBlogAction;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class BlogController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Blog::class);
    }

    /**
         * @OA\Get(
         *      path="/blog",
         *      operationId="getBlogs",
         *      tags={"Blog"},
         *      summary="get blogs list",
         *      description="Returns list of blogs",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/BlogResource")
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
    public function index(BlogRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            BlogResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/blog/{id}",
     *      operationId="getBlogById",
     *      tags={"Blog"},
     *      summary="Get blog information",
     *      description="Returns blog data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Blog id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BlogResource")
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
    public function show(Blog $blog): JsonResponse
    {
        return Response::data(
            BlogResource::make($blog),
        );
    }

    /**
     * @OA\Post(
     *      path="/blog",
     *      operationId="storeBlog",
     *      tags={"Blog"},
     *      summary="Store new blog",
     *      description="Returns new blog data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBlogRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BlogResource")
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
    public function store(StoreBlogRequest $request): JsonResponse
    {
        $model = StoreBlogAction::run($request->validated());
        return Response::data(
            BlogResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('blog.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/blog/{id}",
     *      operationId="updateBlog",
     *      tags={"Blog"},
     *      summary="Update existing blog",
     *      description="Returns updated blog data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Blog id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBlogRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/BlogResource")
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
     *          description="Blog Not Found"
     *      )
     * )
     */
    public function update(UpdateBlogRequest $request, Blog $blog): JsonResponse
    {
        $data = UpdateBlogAction::run($blog, $request->all());
        return Response::data(
            BlogResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('blog.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/blog/{id}",
     *      operationId="deleteBlog",
     *      tags={"Blog"},
     *      summary="Delete existing blog",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Blog id",
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
    public function destroy(Blog $blog): JsonResponse
    {
        DeleteBlogAction::run($blog);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('blog.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
