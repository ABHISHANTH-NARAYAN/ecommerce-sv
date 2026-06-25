<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{

        public function index()
{
    $cartItems = session()->get('cart', []);
    $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
    
    $discount = session()->has('coupon') ? session('coupon')['discount'] : 0;
    $total = max(0, $subtotal - $discount);

    return view('cart.index', compact('cartItems', 'subtotal', 'discount', 'total'));
}
    

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        $qty = $request->quantity ?? 1;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $qty;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "image" => $product->image,
                "quantity" => $qty,
            ];
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Added to cart!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
        }

        session()->put('cart', $cart);

        return back();
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        unset($cart[$id]);

        session()->put('cart', $cart);

        return back();
    }

    public function clear()
    {
        session()->forget('cart');
        return back();
    }
  public function applyCoupon(Request $request)
{
    // Define your inbuilt coupons here
    $validCoupons = [
        'SAVE10' => ['type' => 'flat', 'value' => 100],        // ₹100 off
        'WELCOME20' => ['type' => 'percent', 'value' => 20],   // 20% off
        'FREESHIP' => ['type' => 'flat', 'value' => 50],       // ₹50 off (Simulating free shipping)
    ];

    $code = strtoupper($request->coupon_code);

    if (array_key_exists($code, $validCoupons)) {
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $discountAmount = 0;

        // Calculate the discount based on the type
        if ($validCoupons[$code]['type'] === 'flat') {
            $discountAmount = $validCoupons[$code]['value'];
        } elseif ($validCoupons[$code]['type'] === 'percent') {
            $discountAmount = ($subtotal * $validCoupons[$code]['value']) / 100;
        }

        // Ensure the discount isn't larger than the subtotal itself
        $discountAmount = min($discountAmount, $subtotal);

        session()->put('coupon', [
            'code' => $code,
            'discount' => $discountAmount
        ]);

        return back()->with('success', "Coupon '{$code}' applied successfully!");
    }

    return back()->with('error', 'Invalid or expired coupon code.');
}

public function removeCoupon()
{
    session()->forget('coupon');
    return back();
}
}