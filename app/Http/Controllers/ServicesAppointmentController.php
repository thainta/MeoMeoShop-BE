<?php

namespace App\Http\Controllers;

use App\Http\Resources\ServicesAppointmentResource;
use App\Models\ServicesAppointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ServicesAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $servicesAppointment = ServicesAppointment::all();
        return (new ServicesAppointmentResource($servicesAppointment))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $servicesAppointment = ServicesAppointment::create($input);
//        Log::info("ServicesAppointment ID {$servicesAppointment->id} created successfully.");
        return (new ServicesAppointmentResource($servicesAppointment))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(ServicesAppointment $servicesAppointment)
    {
        return (new ServicesAppointmentResource($servicesAppointment))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ServicesAppointment $servicesAppointment)
    {
        $servicesAppointment->update($request->all());

        return (new ServicesAppointmentResource($servicesAppointment))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ServicesAppointment $servicesAppointment)
    {
        $servicesAppointment->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
