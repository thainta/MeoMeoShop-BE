<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelBookingResource;
use App\Models\HotelBooking;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HotelBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelBooking = HotelBooking::all();
        return (new HotelBookingResource($hotelBooking))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $hotelBooking = HotelBooking::create($input);
//        Log::info("HotelBooking ID {$hotelBooking->id} created successfully.");
        return (new HotelBookingResource($hotelBooking))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelBooking $hotelBooking)
    {
        return (new HotelBookingResource($hotelBooking))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotelBooking $hotelBooking)
    {
        $hotelBooking->update($request->all());

        return (new HotelBookingResource($hotelBooking))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotelBooking $hotelBooking)
    {
        $hotelBooking->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
