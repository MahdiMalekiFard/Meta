<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Actions\Comment\StoreCommentAction;
use App\Actions\Comment\DeleteCommentAction;
use App\Actions\Comment\UpdateCommentAction;
use App\Repositories\Comment\CommentRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CommentController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Comment::class);
    }

    /**
         * @OA\Get(
         *      path="/comment",
         *      operationId="getComments",
         *      tags={"Comment"},
         *      summary="get comments list",
         *      description="Returns list of comments",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/CommentResource")
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
    public function index(CommentRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CommentResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/comment/{id}",
     *      operationId="getCommentById",
     *      tags={"Comment"},
     *      summary="Get comment information",
     *      description="Returns comment data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CommentResource")
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
    public function show(Comment $comment): JsonResponse
    {
        return Response::data(
            CommentResource::make($comment),
        );
    }

    /**
     * @OA\Post(
     *      path="/comment",
     *      operationId="storeComment",
     *      tags={"Comment"},
     *      summary="Store new comment",
     *      description="Returns new comment data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCommentRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CommentResource")
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
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $model = StoreCommentAction::run($request->validated());
        return Response::data(
            CommentResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('comment.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/comment/{id}",
     *      operationId="updateComment",
     *      tags={"Comment"},
     *      summary="Update existing comment",
     *      description="Returns updated comment data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCommentRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CommentResource")
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
     *          description="Comment Not Found"
     *      )
     * )
     */
    public function update(UpdateCommentRequest $request, Comment $comment): JsonResponse
    {
        $data = UpdateCommentAction::run($comment, $request->all());
        return Response::data(
            CommentResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('comment.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/comment/{id}",
     *      operationId="deleteComment",
     *      tags={"Comment"},
     *      summary="Delete existing comment",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Comment id",
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
    public function destroy(Comment $comment): JsonResponse
    {
        DeleteCommentAction::run($comment);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('comment.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
