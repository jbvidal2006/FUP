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
        return response()->json(['status' => true, 'data' => $sales]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sales $sales)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $sales = Sales::find($id);

        if (!$sales) {
            return response()->json([
                'status' => false,
                'message' => 'Sale not found'
            ], 404);
        }

        $validatedData = $request->validate([
            'sal_dateSales' => 'required|date',
            'people_id' => 'required|integer',
            'products_id' => 'required|integer'
        ]);

        $sales->update($validatedData);
        return response()->json([
            'status' => true,
            'message' => "successfully sale update"
        ], 200);
    }

    public function destroy($id)
    {

        $sales = Sales::where('id', $id)->first();
        $sales->delete();
        return response()->json([
            'status' => true,
            'message' => "successfully sales delete"
        ], 200);
    }
}
