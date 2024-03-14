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

    public function update(Request $request, Sales $sales)
    {
        try {
            $validatedData = $request->validate([
                'sal_dateSales' => 'required|date',
                'people_id' => 'required|integer',
                'products_id' => 'required|integer'
            ]);

            $sales = new Sales($validatedData);
            $sales->update();

            return response()->json([
                'status' => true,
                'message' => "successfully sale update"
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => "Sale does not exist"
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }
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
