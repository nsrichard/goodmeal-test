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

    public function index(Request $request)
    {
        $store_id = (int) $request->input('store_id', -1);
        $products = Product::where(function ($query) use ($store_id){
            if ($store_id > -1){
                $query->where('store_id', '=', $store_id);
            }
        })->get();
        return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'products list', 'data' => $products]);
    }

    public function show(Product $product)
    {
        return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'found data', 'data' => $product]);
    }

    public function store(ProductRequest $request){
        $product = new Product();
        if ($product->fillAndSave($request->all()))
            return $this->response(StatusCode::HTTP_CREATED, 'OK', ['message' => 'created successfully', 'data' => $product]);
        else 
            return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
    }

    public function update(ProductRequest $request, Product $product)
    {
        if ($product->fillAndSave($request->all()))
            return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'updated successfully', 'data' => $product]);
        else 
            return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
    }

    public function destroy(Product $product)
    {
        if ($product->delete()) 
            return $this->response(StatusCode::HTTP_OK, 'OK', ['response' => 'deleted successfully']);
        else 
            return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'OK', ['response' => 'Internal error']);
    }

}
