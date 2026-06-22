<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::with('product')
            ->latest()
            ->get();

        return view('admin.enquiries.index', compact('enquiries'));
    }

    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();

        return redirect()
            ->route('enquiries.index')
            ->with('success', 'Enquiry deleted successfully.');
    }
}

