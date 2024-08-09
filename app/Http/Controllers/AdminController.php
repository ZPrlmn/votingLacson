<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('adminLogin'); 
    }

    public function login(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'password' => 'required|string',
        ]);

        $admin = Admin::where('user_name', $request->input('user_name'))->first();

        if ($admin && $admin->password === $request->input('password')) {            
            return redirect()->route('home'); 
        }
        
        return redirect()->route('admin.login')->with('error', 'Invalid credentials.');
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'user_name' => 'required|string|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new admin instance
        $admin = new Admin([
            'user_name' => $request->input('user_name'),
            'password' => $request->input('password'), // Store the plain text password
        ]);

        // Save the admin to the database
        $admin->save();

        // Redirect to the correct route
        return redirect()->route('adminRegister')->with('success', 'Admin created successfully.');
    }
    
}
