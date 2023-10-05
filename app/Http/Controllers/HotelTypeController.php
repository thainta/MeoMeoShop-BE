<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelTypeResource;
use App\Models\HotelType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HotelTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hotelType = HotelType::all();
        return (new HotelTypeResource($hotelType))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $hotelType = HotelType::create($input);
//        Log::info("HotelType ID {$hotelType->id} created successfully.");
        return (new HotelTypeResource($hotelType))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(HotelType $hotelType)
    {
        return (new HotelTypeResource($hotelType))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HotelType $hotelType)
    {
        $hotelType->update($request->all());

        return (new HotelTypeResource($hotelType))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HotelType $hotelType)
    {
        $hotelType->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
