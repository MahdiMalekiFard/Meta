<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Country;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Resources\CountryResource;
use App\Actions\Country\StoreCountryAction;
use App\Actions\Country\DeleteCountryAction;
use App\Actions\Country\UpdateCountryAction;
use App\Repositories\Country\CountryRepositoryInterface;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CountryController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:sanctum');
        $this->authorizeResource(Country::class);
    }

    /**
         * @OA\Get(
         *      path="/country",
         *      operationId="getCountrys",
         *      tags={"Country"},
         *      summary="get countrys list",
         *      description="Returns list of countrys",
         *      @OA\Response(
         *          response=200,
         *          description="Successful operation",
         *          @OA\JsonContent(ref="#/components/schemas/CountryResource")
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
    public function index(CountryRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CountryResource::collection($repository->paginate())
        );
    }

    /**
     * @OA\Get(
     *      path="/country/{id}",
     *      operationId="getCountryById",
     *      tags={"Country"},
     *      summary="Get country information",
     *      description="Returns country data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Country id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CountryResource")
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
    public function show(Country $country): JsonResponse
    {
        return Response::data(
            CountryResource::make($country),
        );
    }

    /**
     * @OA\Post(
     *      path="/country",
     *      operationId="storeCountry",
     *      tags={"Country"},
     *      summary="Store new country",
     *      description="Returns new country data",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCountryRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CountryResource")
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
    public function store(StoreCountryRequest $request): JsonResponse
    {
        $model = StoreCountryAction::run($request->validated());
        return Response::data(
            CountryResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('country.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *      path="/country/{id}",
     *      operationId="updateCountry",
     *      tags={"Country"},
     *      summary="Update existing country",
     *      description="Returns updated country data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Country id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCountryRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(ref="#/components/schemas/CountryResource")
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
     *          description="Country Not Found"
     *      )
     * )
     */
    public function update(UpdateCountryRequest $request, Country $country): JsonResponse
    {
        $data = UpdateCountryAction::run($country, $request->all());
        return Response::data(
            CountryResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('country.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/country/{id}",
     *      operationId="deleteCountry",
     *      tags={"Country"},
     *      summary="Delete existing country",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Country id",
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
    public function destroy(Country $country): JsonResponse
    {
        DeleteCountryAction::run($country);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('country.model')]),
            Response::HTTP_NO_CONTENT
        );
    }
}
