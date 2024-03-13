<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }



    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'use_phone' => 'required|unique:users',
                'use_password' => 'required',
                'use_rol' => 'required',
                'use_status' => 'required',
                'people_id' => 'required'
            ]);

            $user = User::create([
                'use_phone' => $request->use_phone,
                'use_password' => Hash::make($request->use_password),
                'use_rol' => $request->use_rol,
                'use_status' => $request->use_status,
                'people_id' => $request->people_id,
            ]);


            return response()->json([
                'status' => true,
                'message' => "User successfully created",
                'data' => $user
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }

        /*$user = new User($validatedData);
            $user->save();*/
    }


    public function show(User $user)
    {
        return response()->json(['status' => true, 'data' => $user]);
    }


    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'use_phone' => 'required|unique:users',
                'use_password' => 'sometimes|required',
                'use_rol' => 'required',
                'use_status' => 'required',
                'people_id' => 'required'
            ]);

            $user = User::findOrFail($id);

            // Actualiza el teléfono y otros campos
            $user->update([
                'use_phone' => $request->use_phone,
                'use_rol' => $request->use_rol,
                'use_status' => $request->use_status,
                'people_id' => $request->people_id,
            ]);

            // Actualiza la contraseña si se proporciona
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => "User successfully deleted"
        ], 200);
    }
}
