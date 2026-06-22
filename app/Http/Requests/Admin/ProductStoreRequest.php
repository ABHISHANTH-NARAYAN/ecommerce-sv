<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand_id'    => 'required|exists:brands,id',
            'name'        => 'required|string|max:255',

            // ✅ PRICE ADDED (VERY IMPORTANT)
            'price'       => 'required|numeric|min:0',

            'description' => 'required|string',
            'status'      => 'required',
            'stock'       => 'required|integer|min:0',

            // better boolean handling
            'featured'    => 'nullable|boolean',

            'colors'      => 'nullable|array',
            'colors.*'    => 'exists:colors,id',

            'image'       => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ];
    }
}