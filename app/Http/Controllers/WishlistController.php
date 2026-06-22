<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = session()->get('wishlist', []);
        return view('wishlist.index', compact('wishlist'));
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);

        $wishlist = session()->get('wishlist', []);

        $wishlist[$id] = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image
            
        ];

        session()->put('wishlist', $wishlist);

        return response()->json(['success' => true]);
    }

    public function remove($id)
    {
        $wishlist = session()->get('wishlist', []);

        unset($wishlist[$id]);

        session()->put('wishlist', $wishlist);

       return redirect()->route('wishlist.index')
        ->with('success', 'Product removed ');
    }

    public function moveToCart($id)
{
    $wishlist = session()->get('wishlist', []);

    if (!isset($wishlist[$id])) {
        return redirect()->back()->with('error', 'Product not found in wishlist');
    }

    $cart = session()->get('cart', []);

    if (isset($cart[$id])) {
        $cart[$id]['quantity']++;
    } else {
        $cart[$id] = [
            'id' => $wishlist[$id]['id'],
            'name' => $wishlist[$id]['name'],
            'price' => $wishlist[$id]['price'],
            'image' => $wishlist[$id]['image'],
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    // Remove from wishlist
    unset($wishlist[$id]);
    session()->put('wishlist', $wishlist);

    return redirect()->route('wishlist.index')
        ->with('success', 'Product moved to cart successfully');
}
}