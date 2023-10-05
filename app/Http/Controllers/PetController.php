<?php

namespace App\Http\Controllers;

use App\Http\Resources\PetResource;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PetController extends Controller
{/**
 * Display a listing of the resource.
 */
    public function index()
    {
        $pet = Pet::all();
        return (new PetResource($pet))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $pet = Pet::create($input);
//        Log::info("Pet ID {$pet->id} created successfully.");
        return (new PetResource($pet))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Pet $pet)
    {
        return (new PetResource($pet))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pet $pet)
    {
        $pet->update($request->all());

        return (new PetResource($pet))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pet $pet)
    {
        $pet->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
