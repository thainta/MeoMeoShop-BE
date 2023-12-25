<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Image;
use App\Models\Product;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['imgUrl'] = "https://res.cloudinary.com/devkynlcz/image/upload/".$data['imgUrl'];
    
        return $data;
    }
    protected function handleRecordCreation(array $data): Model
    {
        $imgData = $data['images'];
        unset($data['images']);
        $record =  static::getModel()::create($data);
        for($i =0; $i < count($imgData); $i++){
            error_log( "record: ".$imgData[$i]);
            $image = new Image();
            $image->url = "https://res.cloudinary.com/devkynlcz/image/upload/".$imgData[$i];
            $image->product_id = $record->id; 
            $image->save();
        }

        return $record;
    }
    
    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
