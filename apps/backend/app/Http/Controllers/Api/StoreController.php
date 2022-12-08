<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Http\StatusCode;
use App\Models\Store;

class StoreController extends Controller
{

	/** @OA\Get(path="/api/store", tags={"store"}, summary="Store list",
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=401, description="HTTP_UNAUTHORIZED"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function index()
	{
		$stores = Store::whereHas('products', function ($query) {
            $query->where('stock', '>', 0);
        })->get();
		return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'stores list', 'data' => $stores]);
	}

	/** @OA\Get(path="/api/store/{id}", tags={"store"}, summary="show store",
	 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer") ),
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=404, description="HTTP_NOT_FOUND"),
	 *     @OA\Response(response=401, description="HTTP_UNAUTHORIZED"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function show(Store $store)
	{
		return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'found data', 'data' => $store->load('products.category')]);
	}

	/** @OA\Post(path="/api/store", tags={"store"}, summary="add store",
	 *     @OA\RequestBody( @OA\MediaType( mediaType="application/json", @OA\Schema(
	 *       @OA\Property(property="name", type="string"),
	 *       @OA\Property(property="about", type="string"),
	 *       @OA\Property(property="logo", type="string"),
	 *       @OA\Property(property="banner", type="string"),
	 *       @OA\Property(property="service", type="string"),
	 *       @OA\Property(property="lat", type="double"),
	 *       @OA\Property(property="lng", type="double"),
	 *       example={"name": "test name", "about": "about data", "logo": "https://www...", "banner":"https://www...", "service": "all", "lat": 79.58484981, "lng": 19.61854198}
	 *     ))),
	 *     @OA\Response(response=201, description="HTTP_CREATED"),
	 *     @OA\Response(response=403, description="HTTP_FORBIDDEN"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function store(StoreRequest $request){
		$store = new Store();
		if ($store->fillAndSave($request->all()))
			return $this->response(StatusCode::HTTP_CREATED, 'OK', ['message' => 'created successfully', 'data' => $store]);
		else 
			return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
	}

	/** @OA\Put(path="/api/store/{id}", tags={"store"}, summary="update store",
	 *     @OA\RequestBody( @OA\MediaType( mediaType="application/json", @OA\Schema(
	 *       @OA\Property(property="name", type="string"),
	 *       @OA\Property(property="about", type="string"),
	 *       @OA\Property(property="logo", type="string"),
	 *       @OA\Property(property="banner", type="string"),
	 *       @OA\Property(property="service", type="string"),
	 *       @OA\Property(property="lat", type="double"),
	 *       @OA\Property(property="lng", type="double"),
	 *       example={"name": "test name", "about": "about data", "logo": "https://www...", "banner":"https://www...", "service": "all", "lat": 79.58484981, "lng": 19.61854198}
	 *     ))),
	 *     @OA\Response(response=201, description="HTTP_OK"),
	 *     @OA\Response(response=404, description="HTTP_NOT_FOUND"),
	 *     @OA\Response(response=403, description="HTTP_FORBIDDEN"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function update(StoreRequest $request, Store $store)
	{
		if ($store->fillAndSave($request->all()))
			return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'updated successfully', 'data' => $store]);
		else 
			return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
	}

	/** @OA\Delete(path="/api/store/{id}", tags={"store"}, summary="delete store",
	 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer") ),
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=404, description="HTTP_NOT_FOUND"),
	 *     @OA\Response(response=403, description="HTTP_FORBIDDEN"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function destroy(Store $store)
	{
		if ($store->delete()) 
			return $this->response(StatusCode::HTTP_OK, 'OK', ['response' => 'deleted successfully']);
		else 
			return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'OK', ['response' => 'Internal error']);
	}

}
