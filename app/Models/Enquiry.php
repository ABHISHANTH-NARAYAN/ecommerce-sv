<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'phone',
        'email',
        'message'
    ];

   public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}
}