<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderDeliveredMail;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();

        return view('admin.order.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product');

        return view('admin.order.show', compact('order'));
    }
    public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required'
    ]);

    $oldStatus = $order->status;

    $order->update([
        'status' => $request->status
    ]);

    // Send email only when status becomes Delivered
    if (
        $request->status === 'Delivered' &&
        $oldStatus !== 'Delivered' &&
        !empty($order->email)
    ) {
        Mail::to($order->email)
            ->send(new OrderDeliveredMail($order));
    }

    return back()->with('success', 'Order status updated successfully.');
}
}
