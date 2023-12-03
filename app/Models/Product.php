<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "name",
        "description",
        "imgUrl",
        "price",
        "stock_quantity",
        "species",
        "category",
        "sub_category",
        "brand"
    ];

    public function image(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
