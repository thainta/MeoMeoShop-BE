<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ImageResource;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ImageController extends Controller
{
/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $image = Image::All();
        return (new ImageResource($image))->response();
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
        $input['url'] = $uploadedFileUrl;
        $image = Image::create($input);
        return (new ImageResource($image))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        return (new ImageResource($image))->response();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        $image->update($request->all());

        return (new ImageResource($image))->response();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return response(null)->setStatusCode(Response::HTTP_NO_CONTENT);
    }
}
