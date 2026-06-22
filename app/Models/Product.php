<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Review;
use App\Models\Enquiry;

class Product extends Model
{
    protected $fillable = [
    'name',
    'price',
    'description',
    'image',
    'stock',
    'status',
    'featured',
];
    /**
     * Product belongs to a Brand
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Product has many Colors
     */
    public function colors()
    {
        return $this->belongsToMany(
            Color::class,
            'product_color', // pivot table
            'product_id',
            'color_id'
        );
    }
    public function reviews()
{
    return $this->hasMany(Review::class);
}

public function enquiries()
{
    return $this->hasMany(Enquiry::class);
}

}