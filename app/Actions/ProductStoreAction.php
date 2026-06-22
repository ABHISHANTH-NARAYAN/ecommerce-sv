<?php

namespace App\Actions;

use App\Models\Product;

class ProductStoreAction
{
    public function execute(array $data): Product
    {
        $product = Product::create([
            'brand_id'    => $data['brand_id'] ?? null,
            'name'        => $data['name'],
            'price'       => $data['price'], // ✅ ADDED PRICE (IMPORTANT FIX)
            'description' => $data['description'],
            'status'      => $data['status'],
            'stock'       => $data['stock'],
            'featured'    => $data['featured'] ?? 0,

            // safe image handling
            'image'       => isset($data['image'])
                ? $data['image']->store('products', 'public')
                : null,
        ]);

        // attach colors if exist
        if (!empty($data['colors'])) {
            $product->colors()->attach($data['colors']);
        }

        return $product;
    }
}