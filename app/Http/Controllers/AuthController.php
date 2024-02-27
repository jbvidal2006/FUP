<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create(Request $request)
    {
        $rules = [
            'name' => 'required|string',
            'phone' => 'required|unique:users',
            'password' => 'required|'
        ];
        $Validator = Validator($request->input(), $rules);

        if ($Validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $Validator->errors()->all()
            ], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);
        return response()->json([
            'status' => true,
            'errors' => 'user created successfully',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ], 200);
    }

    public function login(Request $request)
    {
        $rules = [
            'phone' => 'required',
            'password' => 'required|'
        ];

        $Validator = Validator($request->input(), $rules);

        if ($Validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $Validator->errors()->all()
            ], 400);
        }
        if (!Auth::attempt($request->only('phone', 'password'))) {
            return response()->json([
                'status' => false,
                'errors' => ['Unauthorized']
            ], 401);
        }
        $user = User::where('phone', $request->phone)->first();
        return response()->json([
            'status' => true,
            'errors' => 'user login successfully',
            'data'=> $user,
            'token' => $user->createToken('API TOKEN')->plainTextToken

        ], 200);
    }

    public function logout()
    {
        $tokens = auth()->user()->tokens;
        foreach ($tokens as $token) {
            $token->delete();
        }
        return response()->json([
            'status' => true,
            'message' => 'user logout'
        ], 200);
    }
}
