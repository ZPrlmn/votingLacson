<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $student_id = $request->input('student_id');

        $user = User::where('student_id', $student_id)->first();

        if ($user) {
            Auth::login($user);
            return redirect()->route('voting');
        } else {
            return redirect()->route('login')->with('error', 'Student ID not found');
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'student_id' => 'required|unique:users|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'year' => 'required|integer'
        ]);

        User::create([
            'student_id' => $request->input('student_id'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'course' => $request->input('course'),
            'year' => $request->input('year'),
            'has_voted' => false,
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }
}
