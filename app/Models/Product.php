<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    protected $cast = [
        'imgUrl' => 'array'
    ];
}
