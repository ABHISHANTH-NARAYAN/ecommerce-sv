<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Register;

class UserController extends Controller
{
    // Show Create Form
    public function create()
    {
        return view('create');
    }

    // Store New Record
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100',
            'age'      => 'required|integer|min:1|max:120',
            'email'    => 'required|email',
            'phone'    => 'required|string|max:20',
            'image'    => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
        }

        $register = new Register();
        $register->username = $request->username;
        $register->age = $request->age;
        $register->email = $request->email;
        $register->phone = $request->phone;
        $register->image = $imagePath;
        $register->save();

        return redirect()->back()->with('success', 'User saved successfully!');
    }

    // List All Records
    public function index()
    {
        $registers = Register::all();

        return view('list', compact('registers'));
    }

    // View Single Record
    public function show($id)
    {
        $register = Register::findOrFail($id);

        return view('show', compact('register'));
    }

    // Show Edit Form
    public function edit($id)
    {
        $register = Register::findOrFail($id);

        return view('edit', compact('register'));
    }

    // Update Record
    public function update(Request $request, $id)
    {
        $register = Register::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:100',
            'age'      => 'required|integer|min:1|max:120',
            'email'    => 'required|email',
            'phone'    => 'required|string|max:20',
            'image'    => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $register->username = $request->username;
        $register->age = $request->age;
        $register->email = $request->email;
        $register->phone = $request->phone;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $register->image = $imagePath;
        }

        $register->save();

        return redirect()->route('register.index')
            ->with('success', 'User updated successfully!');
    }

    // Delete Record
    public function destroy($id)
    {
        $register = Register::findOrFail($id);

        $register->delete();

        return redirect()->route('register.index')
            ->with('success', 'User deleted successfully!');
    }
}