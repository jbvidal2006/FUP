<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        // Ajusta las reglas de validación para el inicio de sesión
        $validatedData = $request->validate([
            'use_cc' => 'required',
            'use_password' => 'required'
        ]);

        // Busca al usuario por 'use_cc'
        $user = User::where('use_cc', $request->use_cc)->first();

        // Asegúrate de que el usuario exista antes de intentar crear un token
        if (!$user  || $user->use_status == 0) {
            return response()->json([
                'status' => false,
                'errors' => ['usuario no existe o cuenta inhabilitada']
            ], 404);
        }


        // Intenta autenticar al usuario con el teléfono y la contraseña
        if (!Auth::attempt(['use_cc' => $request->use_cc, 'password' => $request->use_password])) {
            return response()->json([
                'status' => false,
                'errors' => ['Validation Error']
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
        try {
            $tokens = auth()->user()->tokens;
            foreach ($tokens as $token) {
                $token->delete();
            }
            return response()->json([
                'status' => true,
                'message' => 'user logout'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Error al cerrar sesión: ' . $e->getMessage()
            ], 500);
        }
    }
}
