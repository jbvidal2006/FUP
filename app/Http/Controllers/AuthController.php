<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Ajusta las reglas de validación para el inicio de sesión
        $validatedData = $request->validate([
            'use_phone' => 'required',
            'use_password' => 'required'
        ]);

         // Busca al usuario por 'use_phone'
         $user = User::where('use_phone', $request->use_phone)->first();

         // Asegúrate de que el usuario exista antes de intentar crear un token
         if (!$user) {
             return response()->json([
                 'status' => false,
                 'errors' => ['User not found']
             ], 404);
         }


        // Intenta autenticar al usuario con el teléfono y la contraseña
        if (!Auth::attempt($request->only('use_phone', 'use_password'))) {
            return response()->json([
                'status' => false,
                'errors' => ['password incorrect']
            ], 401);
        }


        // Genera y devuelve el token
        return response()->json([
            'status' => true,
            'message' => 'User login successfully',
            'data' => $user,
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
