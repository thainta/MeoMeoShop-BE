<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\CreateRecord;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    $data['imgUrl'] = "https://res.cloudinary.com/devkynlcz/image/upload/".$data['imgUrl'];
 
    return $data;
}
}
