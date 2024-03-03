<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

            $user = new User($validatedData);
            $user->save();

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
    }


    public function show(User $user)
    {
        return response()->json(['status' => true, 'data' => $user]);
    }


    public function update(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'use_phone' => 'required|unique:users,use_phone,' . $user->id,
                'use_password' => 'sometimes|required',
                'use_rol' => 'sometimes|required',
                'use_status' => 'sometimes|required',
                'people_id' => 'sometimes|required'
            ]);

            $user = new User($validatedData);
            $user->update();

            return response()->json([
                'status' => true,
                'message' => "User successfully updated",
                'data' => $user
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
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
