<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $fields = $request->all();
        $user = User::where('email', $fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response()->json([
                'error' => 'Email atau Password Salah'
            ], 200);
        }
        $token = $user->createToken('token')->plainTextToken;
        return response()->json([
            'success' => 'Berhasil Login',
            'data' => $user,
            'token' => $token,
        ], 200);
    }

    public function register(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);
         
        if ($validator->fails()) {
            return response()->json(['error'=>'Data Gagal Disimpan'], 200);
        }
        $fields = $request->all();
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);
        return response()->json([                
                'message' => 'Data Berhasil Disimpan',
                'user' => $user,
        ], 200);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->currentAccessToken()->delete();
        return response()->json([
            'success' => true
        ], 200);
    }
}
