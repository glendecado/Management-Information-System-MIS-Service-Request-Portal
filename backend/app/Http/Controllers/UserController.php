<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    //user login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ]);
    }


    ///view user by id
    public function viewUser($name)
    {
        // Retrieve the user by their ID
        $users = User::where('name', 'like', '%' . $name . '%')->get();

        if ($users->isNotEmpty()) {
            return response()->json($users);
        } else {
            return response()->json(['message' => 'No users found'], 404);
        }
    }

    //user view own profile
    public function viewProfile()
    {
        $user = Auth::user();
        return response()->json($user);
    }

    /// user logout
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }


}
