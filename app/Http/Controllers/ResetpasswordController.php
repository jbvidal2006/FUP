<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;


class ResetpasswordController extends Controller

{

    //Esta funcion se usara para crear un token y enviar el correo a la persona que desea recuperar su contraseña
    public function crearTokenAndEnviarCorreo(Request $request)
    {


        try {
            // Validar los datos de entrada
            $validatedData =  $request->validate([
                'peo_mail' => 'required|exists:people,peo_mail'
            ]);

             // Generamos un token único
             $token = Str::random(64);


            // Eliminamos la anterior reseteo de contraseña sin terminar
            DB::table('password_reset_tokens')->where(['phone' => $request->peo_mail])->delete();



            DB::table('password_reset_tokens')->insert([
                'phone' => $request->peo_mail,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
            Mail::send('resetpassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->peo_mail);
                $message->subject('Recuperar Contraseña');
            });



            return response()->json([
                'status' => true,
                'email' => $request->peo_mail,
                'data' => 'correo enviado con exito'
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'data' => 'No se pudo enviar el correo',
                'errors' => $e->errors()
            ], 400);
        }
    }



    public function actualizarContraseniaNueva(Request $request,$id) {

        try {
            $validatedData = $request->validate([
                'use_cc' => 'sometimes|required|unique:users,use_cc,' . $id,
                'use_password' => 'sometimes',
            ]);

            $user = User::findOrFail($id);

            // Actualiza si se proporciona
            if ($request->has('use_password')) {
                $user->update([
                    'use_password' => Hash::make($request->use_password),
                ]);
            }

            return response()->json([
                'status' => true,
                'message' => "User successfully updated",
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => "User not found"
            ], 404);
        }

    }
}
