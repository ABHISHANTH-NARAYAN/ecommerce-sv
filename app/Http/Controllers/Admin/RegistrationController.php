<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;

class RegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::latest()->get();

        return view('admin.registrations.index', compact('registrations'));
    }

    public function destroy(Registration $registration)
    {
        $registration->delete();

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Registration deleted successfully.');
    }
}
