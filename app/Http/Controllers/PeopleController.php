<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $people = People::all();
        return response()->json($people);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'peo_name' => 'required|string|max:80',
            'peo_lastName' => 'required|string|max:80',
            'peo_adress' => 'required|mail',
            'peo_phone' => 'required|integer|digits:10',
            'peo_dateBirth' => 'required|date',
            'peo_image' => 'required|string',
            'peo_status' => 'required'
        ];
        $Validator =  Validator($request->input(), $rules);
        if ($Validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $Validator->errors()->all()
            ], 400);
        }

        $people = new People($request->input());
        $people->save();
        return response()->json([
            'status' => true,
            'message' => "successfully people create"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $person = People::where('id', $id)->first();

        if ($person) {
            return response()->json([
                'status' => true,
                'data' => $person
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Person not found'
            ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'peo_name' => 'required|string|max:80',
            'peo_lastName' => 'required|string|max:80',
            'peo_adress' => 'required|mail',
            'peo_phone' => 'required|integer|digits:10',
            'peo_dateBirth' => 'required|date',
            'peo_image' => 'required|string',
            'peo_status' => 'required'
        ];
        $Validator =  Validator($request->input(), $rules);
        if ($Validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $Validator->errors()->all()
            ], 400);
        }
        // Intenta encontrar el modelo People por el ID proporcionado
        $people = People::find($id);

        // Verifica si el modelo fue encontrado
        if (!$people) {
            return response()->json([
                'status' => false,
                'message' => 'Person not found'
            ],  404);
        }

        // Actualiza los atributos del modelo y guarda los cambios
        $people->update($request->only([
            'peo_name',
            'peo_lastName',
            'peo_adress',
            'peo_phone',
            'peo_dateBirth',
            'peo_image',
            'peo_status'
        ]));



        return response()->json([
            'status' => true,
            'message' => "successfully people update"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $people = People::where('id', $id)->first();
        $people->delete();
        return response()->json([
            'status' => true,
            'message' => "successfully people delete"
        ], 200);
    }
}
