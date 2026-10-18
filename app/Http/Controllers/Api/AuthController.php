<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    /**
     * Register a new user account
     */
    public function register(Request $request)
    {
        // Validate user input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role_id' => 'required|exists:roles,id'
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id
        ]);

        // Return success response
        return response()->json([
            'message' => 'User Registered Successfully',
            'user' => $user
        ], 201);
    }

    /**
     * Login user
     */
    public function login(Request $request)
    {
        // Validate login request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login
        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        // Load authenticated user and role
        $user = Auth::user()->load('role');

        // Create API token
        $token = $user->createToken('api-token')->plainTextToken;

        // Return login response
        return response()->json([
            'message' => 'Login Successful',
            'token' => $token,
            'user' => $user,
            'role' => $user->role->name
        ], 200);
    }


    public function forgotPassword(Request $request)
    {

        $request->validate([

            'email' =>
            'required|email'

        ]);

        $status =
        Password::sendResetLink(

            $request->only('email')

        );

        return response()->json([

            'message' =>
            ($status)

    ]);

}

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        // Delete current API token
        $request->user()
                ->currentAccessToken()
                ->delete();

        return response()->json([
            'message' => 'Logged Out Successfully'
        ], 200);
    }
}