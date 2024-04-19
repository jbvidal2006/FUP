<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

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

        try {
            $validatedData = $request->validate([
                'peo_name' => 'required|string|max:80',
                'peo_lastName' => 'required|string|max:80',
                'peo_adress' => 'required',
                'peo_dateBirth' => 'required|date',
                'peo_image' => 'required|string',
                'peo_mail' => 'required|string',
                'peo_phone' => 'required|string'
            ]);


            $people = new People($validatedData);
            $people->save();


            return response()->json([
                'status' => true,
                'message' => "successfully people create",
                'data' => $people
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }
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


        $people = People::find($id);

        if (!$people) {
            return response()->json([
                'status' => false,
                'message' => 'Person not found'
            ],  404);
        }


        $validatedData = $request->validate([
            'peo_name' => 'required|string|max:80',
            'peo_lastName' => 'required|string|max:80',
            'peo_adress' => 'required',
            'peo_dateBirth' => 'required|date',
            'peo_image' => 'required|string'
        ]);



        $people->update($validatedData);

        return response()->json([
            'status' => True,
            'message' => 'people update successfully'
        ],  200);
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
