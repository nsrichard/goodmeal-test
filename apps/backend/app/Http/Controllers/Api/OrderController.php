<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\StatusCode;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\OrderHistory;
use App\Models\OrderDetail;

class OrderController extends Controller
{

	/** @OA\Get(path="/api/order", tags={"store"}, summary="Order list",
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=401, description="HTTP_UNAUTHORIZED"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function index()
	{
		$orders = Order::get();
		return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'orders list', 'data' => $orders]);
	}

	/** @OA\Get(path="/api/order/{id}", tags={"order"}, summary="show order",
	 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer") ),
	 *     @OA\Response(response=200, description="HTTP_OK"),
	 *     @OA\Response(response=404, description="HTTP_NOT_FOUND"),
	 *     @OA\Response(response=401, description="HTTP_UNAUTHORIZED"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function show(Order $order)
	{
		return $this->response(StatusCode::HTTP_OK, 'OK', ['message' => 'found data', 'data' => $order->load('details')]);
	}

	/** @OA\Post(path="/api/order", tags={"order"}, summary="add order",
	 *     @OA\Response(response=201, description="HTTP_CREATED"),
	 *     @OA\Response(response=403, description="HTTP_FORBIDDEN"),
	 *     @OA\Response(response=500, description="HTTP_INTERNAL_SERVER_ERROR")
	 * )*/
	public function add(Request $request){

		$data = $request->all();

		$amount = 0;
		$discount = 0;
		$total = 0;
		foreach($data as $item){
			$amount += $item['price'];
			$discount += $item['price'] * $item['discount'] / 100; // amount discount
			$total += $item['price'] - ($item['price'] * $item['discount'] / 100);
		}
		
		$order = new order();
		$order->store_id = $data[0]['store_id'];
		$order->user_id = 1;
		$order->status = 'pending';
		$order->amount = $amount;
		$order->discount = $discount;
		$order->delivery = 0;
		$order->total = $total;

		if ($order->save()){	
			OrderHistory::create(['order_id' => $order->id, 'status' => $order->status]);
			foreach($data as $item){
				OrderDetail::create([
					'product_id' => $item['id'],
					'order_id'	=> $order->id,
					'quantity'	=> 1,
					'amount'	=> $item['price'],
					'discount'	=> $item['discount'], // percent
					'total'	=> $item['price'] - ($item['price'] * $item['discount'] / 100),
				]);
			}
			
			return $this->response(StatusCode::HTTP_CREATED, 'OK', ['message' => 'created successfully', 'data' => $order]);
		} 
		return $this->response(StatusCode::HTTP_ERROR_INTERNAL, 'KO', ['message' => 'Internal error']);
	}

}
