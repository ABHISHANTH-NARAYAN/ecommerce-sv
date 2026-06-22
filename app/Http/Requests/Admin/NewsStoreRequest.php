<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class NewsStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation Rules
     */
    public function rules(): array
    {
        return [
            'news_category_id' => 'required|exists:news_categories,id',
            'title'            => 'required|string|max:280',
            'description'      => 'required|string',
            'status'           => 'required|in:Published,Draft',
            'image'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    /**
     * Custom Messages
     */
    public function messages(): array
    {
        return [
            'news_category_id.required' => 'Please select a category.',
            'news_category_id.exists'   => 'Selected category is invalid.',

            'title.required'            => 'Title is required.',
            'title.max'                 => 'Title cannot exceed 280 characters.',

            'description.required'      => 'Description is required.',

            'status.required'           => 'Please select a status.',
            'status.in'                 => 'Status must be Published or Draft.',

            'image.image'               => 'Uploaded file must be an image.',
            'image.mimes'               => 'Image must be JPG, JPEG, PNG or WEBP.',
            'image.max'                 => 'Image size must not exceed 2MB.',
        ];
    }
}