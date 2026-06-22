<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProductEnquiryMail;

class EnquiryController extends Controller
{
    public function create(Product $product)
    {
        return view('enquiries.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $enquiry = Enquiry::create([
            'product_id' => $product->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        Mail::to('abhishanth.narayan@gmail.com')
            ->send(new ProductEnquiryMail($enquiry));

        return redirect('/')
            ->with('success', 'Enquiry submitted successfully.');
    }
}