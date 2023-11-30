<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return (new ProductResource($product))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $product = Product::create($input);
//        Log::info("Product ID {$product->id} created successfully.");
        return (new ProductResource($product))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return (new ProductResource($product))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->all());

        return (new ProductResource($product))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
    public function getProductBySpecies($species)
    {
        $product = Product::query()->where("species", $species)->get();
        return (new ProductResource($product))->response();
    }

    public function getProductBySpeciesAndCategory($species, $category)
    {
        $product = Product::query()->where(["species" => $species, "category" => $category])->get();
        return (new ProductResource($product))->response();
    }
}
