<?php

namespace App\Http\Controllers;

use App\Models\Sales;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sales::all();
        return response()->json($sales);
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
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'sal_dateSales' => 'required|date',
                'people_id' => 'required|integer',
                'products_id' => 'required|integer'
            ]);

            $provider = new Sales($validatedData);
            $provider->save();

            return response()->json([
                'status' => true,
                'message' => "successfully sale create"
            ], 200);
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
    public function show(Sales $sales)
    {
        return response()->json(['status'=>true, 'data'=>$sales]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sales $sales)
    {
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'sal_dateSales' => 'required|date',
                'people_id' => 'required|integer',
                'products_id' => 'required|integer'
            ]);

            $provider = new Sales($validatedData);
            $provider->update();

            return response()->json([
                'status' => true,
                'message' => "successfully sale update"
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
    public function destroy(Sales $sales)
    {
        $sales->delete();
        return response()->json([
            'status'=> true,
            'message'=>"successfully sale delete"
        ],200);
    }
}