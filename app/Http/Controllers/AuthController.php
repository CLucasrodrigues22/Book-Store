<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // POST [name, email, password]
    public function register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => bcrypt($request->password)
            ]);
            return response()->json([
                'status' => true,
                'message' => 'User created successfully!'
            ], 201);
        } catch (\Exception $e) {

            return response()->json([
                "status" => false,
                "message" => "There was an error registering the user, try again later!",
            ], 500);
        }
    }

    // POST [email, password]
    public function login(LoginRequest $request)
    {
        try {
            // email check
            $user = User::where("email", $request->email)->first();

            if (!empty($user)) {
                // User check
                if (Hash::check($request->password, $user->password)) {
                    // Password matched
                    $token = $user->createToken('token')->plainTextToken;
                    return response()->json([
                        'status' => true,
                        'message' => 'Session started successfully!',
                        'token' => $token,
                        'data' => []
                    ], 200);
                } else {
                    return response()->json([
                        'status' => false,
                        'message' => 'Wrong email address or password!',
                        'data' => []
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Wrong email address or password!',
                    'data' => []
                ], 200);
            }
        } catch (\Exception $e) {

            return response()->json([
                "status" => false,
                "message" => "There was an error logging in, try again later!",
            ], 500);
        }
    }

    // GET [Auth: Token]
    public function profile()
    {
        // Check auth instance
        $userData = auth()->user();

        // Find profile related
        $profile = $userData->profile;

        return response()->json([
            'status' => true,
            'message' => 'Info profile',
            'id' => auth()->user()->id,
            'data' => $userData
        ]);
    }

    // GET [Auth: Token]
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logout successfully!',
            'data' => []
        ]);
    }
}
