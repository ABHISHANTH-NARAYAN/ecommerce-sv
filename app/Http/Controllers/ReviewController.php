<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function create(Product $product)
    {
        return view('reviews.createreview', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
        ]);

        $exists = Review::where('product_id', $product->id)
            ->where('email', $request->email)
            ->exists();

        if ($exists) {
            return back()->with(
                'error',
                'You have already reviewed this product.'
            );
        }

        Review::create([
            'product_id' => $product->id,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'review' => $request->review,
        ]);

        return redirect('/')
            ->with('success', 'Review submitted successfully.');
    }
}