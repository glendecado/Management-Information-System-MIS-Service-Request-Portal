<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MisStaffController extends Controller
{
    public function addUser(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'role' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create the new user
        $user = User::create([
            'role' => $validatedData['role'],
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        // Return a response
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }

    public function dashboard()
    {
        return response()->json(['message' => 'welcome']);
    }
}
