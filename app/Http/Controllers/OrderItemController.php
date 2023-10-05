<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemResource;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orderItem = OrderItem::all();
        return (new OrderItemResource($orderItem))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $orderItem = OrderItem::create($input);
//        Log::info("OrderItem ID {$orderItem->id} created successfully.");
        return (new OrderItemResource($orderItem))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderItem $orderItem)
    {
        return (new OrderItemResource($orderItem))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderItem $orderItem)
    {
        $orderItem->update($request->all());

        return (new OrderItemResource($orderItem))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderItem $orderItem)
    {
        $orderItem->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
