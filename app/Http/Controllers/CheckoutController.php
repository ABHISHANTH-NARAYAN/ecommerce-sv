<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        // Prevent accessing checkout if cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    { 
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Your cart is empty.');
        }

        $validatedData = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // 1. Save the Order to the Database
        $order = Order::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'address' => $request->address,
            'total'   => $total,
            'status'  => 'Pending',
        ]);

        // 2. Save the Order Items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

       // 3. Send Confirmation Email (Pass both Order and Cart)
        try {
            Mail::to($order->email)
                ->send(new OrderConfirmationMail($order, $cart)); // <-- Added $cart here
        } catch (\Exception $e) {
            \Log::error('Mail Error: ' . $e->getMessage());
        }
        

        // 4. Generate Invoice Data
        // Creates a professional invoice number like SV-00014 based on the database ID
        $invoiceNumber = 'SV-' . str_pad($order->id, 5, '0', STR_PAD_LEFT);
        $date = $order->created_at ? $order->created_at->format('d M Y, h:i A') : now()->format('d M Y, h:i A');
        
        // Store the cart items locally before clearing the session
        $invoiceItems = $cart;

        // 5. Clear the Cart
        session()->forget('cart');

        // 6. Return the Digital Receipt/Invoice
        return view('invoice', [
            'customer' => $validatedData,
            'items' => $invoiceItems,
            'total' => $total,
            'invoiceNumber' => $invoiceNumber,
            'date' => $date
        ]);
    }
}