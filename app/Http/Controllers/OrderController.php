<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $order = Order::all();
        return (new OrderResource($order))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
         error_log($input['order_date']);
        $input['order_date'] = date('Y-m-d h:i:s', time());;
        error_log($input['order_date']);
        $order = Order::create($input);
//        Log::info("Order ID {$order->id} created successfully.");
        return (new OrderResource($order))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return (new OrderResource($order))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $order->update($request->all());

        return (new OrderResource($order))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
