<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Laravel OpenApi Demo Documentation",
 *      description="L5 Swagger OpenApi description",
 *      @OA\Contact(
 *          email="admin@admin.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *      @OA\Server(
 *          url=L5_SWAGGER_CONST_HOST,
 *          description="Local Host"
 *      ),
 *     @OA\Server(
 *          url="https://dashboard.metanext.biz/api/v1",
 *          description="production"
 *      )
 *
 *
 */
class BaseApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
