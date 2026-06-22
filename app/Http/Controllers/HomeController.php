<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('reviews')
            ->where('status', 'Available')
            ->where('stock', '>', 0)
            ->when($request->search, function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            })
            ->orderByDesc('featured')
            ->latest()
            ->get();

        // Ensure this matches the file name you are using (welcome or home)
        return view('welcome', compact('products'));
    }

    // Add this for the Product Details page
    public function show($id)
    {
        $product = Product::with('reviews')->findOrFail($id);
        return view('product-show', compact('product'));
    }

    // Add this for the New Arrivals page
    public function newArrivals()
    {
        $products = Product::with('reviews')
            ->where('status', 'Available')
            ->where('stock', '>', 0)
            ->latest()
            ->take(12)
            ->get();

        return view('new-arrivals', compact('products'));
    }
}