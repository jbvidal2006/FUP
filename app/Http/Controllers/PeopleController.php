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
            'peo_name' => 'required',
            'peo_lastName' => 'required',
            'peo_adress' => 'required',
            'peo_phone' => 'required',
            'peo_dateBirth' => 'required',
            'peo_image' => 'required'
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
            'peo_name' => 'required',
            'peo_lastName' => 'required',
            'peo_adress' => 'required',
            'peo_phone' => 'required',
            'peo_dateBirth' => 'required',
            'peo_image' => 'required'
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
            'peo_image'
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
