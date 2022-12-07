<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\Http\StatusCode;
use App\Models\Product;
use App\Models\Store;

class ProductController extends Controller
{

	/** @OA\Get(path="/api/product", tags={"product"}, summary="product list",
	 *     @OA\Parameter(name="store_id", in="path", required=false, @OA\Schema(type="integer") ),
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=401, description="HTTP_UNAUTHORIZED"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function index(Request $request)
	{
		$store_id = (int) $request->input('store_id', -1);
		$products = Product::where(function ($query) use ($store_id){
			if ($store_id > -1){
				$query->where('store_id', '=', $store_id);
			}
		})->with('category')->get();
		return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'products list', 'data' => $products]);
	}

	/** @OA\Get(path="/api/product/{id}", tags={"product"}, summary="show product",
	 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer") ),
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=404, description="HTTP_NOT_FOUND"),
	 *     @OA\Response(response=401, description="HTTP_UNAUTHORIZED"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function show(Product $product)
	{
		return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'found data', 'data' => $product->load('category')]);
	}

	/** @OA\Post(path="/api/product", tags={"product"}, summary="add product",
	 *     @OA\RequestBody( @OA\MediaType( mediaType="application/json", @OA\Schema(
	 *       @OA\Property(property="store_id", type="integer"),
	 *       @OA\Property(property="category_id", type="integer"),
	 *       @OA\Property(property="name", type="string"),
	 *       @OA\Property(property="description", type="string"),
	 *       @OA\Property(property="image", type="string"),
	 *       @OA\Property(property="price", type="string"),
	 *       @OA\Property(property="discount", type="string"),
	 *       @OA\Property(property="stock", type="double"),
	 *       example={"store_id": 1, "category_id": 1, "name": "test name", "description": "description data", "image": "https://www...", "price":15.5, "discount": 20.0, "stock": 25}
	 *     ))),
	 *     @OA\Response(response=201, description="HTTP_CREATED"),
	 *     @OA\Response(response=403, description="HTTP_FORBIDDEN"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function store(ProductRequest $request){
		$product = new Product();
		if ($product->fillAndSave($request->all()))
			return $this->response(StatusCode::HTTP_CREATED, 'OK', ['message' => 'created successfully', 'data' => $product]);
		else 
			return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
	}

	/** @OA\Put(path="/api/product/{id}", tags={"product"}, summary="update product",
	 *     @OA\RequestBody( @OA\MediaType( mediaType="application/json", @OA\Schema(
	 *       @OA\Property(property="store_id", type="integer"),
	 *       @OA\Property(property="category_id", type="integer"),
	 *       @OA\Property(property="name", type="string"),
	 *       @OA\Property(property="description", type="string"),
	 *       @OA\Property(property="image", type="string"),
	 *       @OA\Property(property="price", type="string"),
	 *       @OA\Property(property="discount", type="string"),
	 *       @OA\Property(property="stock", type="double"),
	 *       example={"store_id": 1, "category_id": 1, "name": "test name", "description": "description data", "image": "https://www...", "price":15.5, "discount": 20.0, "stock": 25}
	 *     ))),
	 *     @OA\Response(response=201, description="HTTP_OK"),
	 *     @OA\Response(response=404, description="HTTP_NOT_FOUND"),
	 *     @OA\Response(response=403, description="HTTP_FORBIDDEN"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function update(ProductRequest $request, Product $product)
	{
		if ($product->fillAndSave($request->all()))
			return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'updated successfully', 'data' => $product]);
		else 
			return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
	}

	/** @OA\Delete(path="/api/product/{id}", tags={"product"}, summary="delete product",
	 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer") ),
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=404, description="HTTP_NOT_FOUND"),
	 *     @OA\Response(response=403, description="HTTP_FORBIDDEN"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function destroy(Product $product)
	{
		if ($product->delete()) 
			return $this->response(StatusCode::HTTP_OK, 'OK', ['response' => 'deleted successfully']);
		else 
			return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'OK', ['response' => 'Internal error']);
	}

}
