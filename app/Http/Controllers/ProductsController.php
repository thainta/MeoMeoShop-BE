<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductsResource;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Products::all();
        return (new ProductsResource($product))->response();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $uploadedFileUrl = Cloudinary::upload($request->file('img')->getRealPath(), [
            'folder' => 'MeoMeoShop/ProductImage',
            'resource_type' => 'image'
        ])->getSecurePath();
        $input['imgUrl'] = $uploadedFileUrl;
        $product = Products::create($input);
        return (new ProductsResource($product))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return (new ProductsResource($product))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $product->update($request->all());

        return (new ProductsResource($product))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        $product->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }

    public function getProductByCategory($category)
    {
        $product = Products::query()->where("category", $category)->get();
        return (new ProductsResource($product))->response();
    }

    public function getProductBySpeciesAndCategory($species, $category)
    {
        $product = Products::query()->where(["species" => $species, "category" => $category])->get();
        return (new ProductsResource($product))->response();
    }
}
