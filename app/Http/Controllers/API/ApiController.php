<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    // REGISTER FUNCTION
    public function register(Request $request)
    {
        try {
            $validateuser = Validator::make(
                $request->all(),
                [
                    'name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'password' => 'required',
                ]
            );

            if ($validateuser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateuser->errors()
                ], 401);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'role' => 0,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'User created Succesfully',
                'token' => $user->createToken('API_TOKEN')->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            // Return Json Response
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    // LOGIN FUNCTION
    public function login(Request $request)
    {
        try {
            $validateuser = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email',
                    'password' => 'required',
                ]
            );

            if ($validateuser->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateuser->errors()
                ], 401);
            }

            if (!Auth::attempt(($request->only(['email', 'password'])))) {
                return response()->json([
                    'status' => false,
                    'message' => 'Something went really wrong!',
                ], 401);
            }

            $user = User::where('email', $request->email)->first();

            return response()->json([
                'status' => true,
                'message' => 'Succesfully login',
                'token' => $user->createToken('API_TOKEN')->plainTextToken
            ], 200);
        } catch (\Throwable $th) {
            // Return Json Response
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    // PROFILE INFO FUNCTION
    public function profile()
    {
        // Profile Detail
        $userData = auth()->user();

        // Return Json Response
        return response()->json([
            'status' => true,
            'message' => 'Profile Info',
            'data' => [
                'id' => $userData->id,
                'name' => $userData->name,
                'email' => $userData->email,
                'role' => $userData->role,
            ],
            'id' => auth()->user()->id,
        ], 200);
    }

    // LOGOUT FUNCTION
    public function logout()
    {
        auth()->user()->tokens()->delete();

        // Return Json Response
        return response()->json([
            'status' => true,
            'message' => 'Succesfully Logout',
            'data' => []
        ], 200);
    }
}
