<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\StoreRequest;
use App\Http\Controllers\Controller;
use App\Http\StatusCode;
use App\Models\Store;

class StoreController extends Controller
{

    public function index()
    {
        $stores = Store::get();
        return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'stores list', 'data' => $stores]);
    }

    public function show(Store $store)
    {
        return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'found data', 'data' => $store]);
    }

    public function store(StoreRequest $request){
        $store = new Store();
        if ($store->fillAndSave($request->all()))
            return $this->response(StatusCode::HTTP_CREATED, 'OK', ['message' => 'created successfully', 'data' => $store]);
        else 
            return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
    }

    public function update(StoreRequest $request, Store $store)
    {
        if ($store->fillAndSave($request->all()))
            return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'updated successfully', 'data' => $store]);
        else 
            return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
    }

    public function destroy(Store $store)
    {
        if ($store->delete()) 
            return $this->response(StatusCode::HTTP_OK, 'OK', ['response' => 'deleted successfully']);
        else 
            return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'OK', ['response' => 'Internal error']);
    }

}
