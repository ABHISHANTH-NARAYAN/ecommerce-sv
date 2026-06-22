<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationSuccessMail;

class RegistrationController extends Controller
{
    public function showForm()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'phone' => 'required',
            'email' => 'required|email'
        ]);

        $registration = Registration::create([
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
        ]);

        Mail::to($registration->email)
            ->send(new RegistrationSuccessMail($registration));

        return redirect()
            ->back()
            ->with('success', 'Registration successful.');
    }
}
