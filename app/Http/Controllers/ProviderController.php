<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class ProviderController extends Controller
{

    public function index()
    {
        $provider = Provider::all();
        return response()->json($provider);
    }

    /**
     * Store a newly created resource in storage.

     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'prov_ranking' => 'required|integer',
                'prov_imageRanking' => 'required',
                'prov_email' => 'required',
                'prov_group' => 'required|string',
                'prov_description' => 'required|string',
                'prov_status' => 'required',
                'people_peo_id' => 'required'
            ]);


            $provider = new Provider($validatedData);
            $provider->save();


            return response()->json([
                'status' => true,
                'message' => "successfully provider create"
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
    public function show(Provider $provider)
    {
        return response()->json(['status' => true, 'data' => $provider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'prov_ranking' => 'required|integer',
                'prov_imageRanking' => 'required',
                'prov_email' => 'required',
                'prov_group' => 'required|string',
                'prov_description' => 'required|string',
                'prov_status' => 'required',
                'people_peo_id' => 'required'
            ]);

            $provider = new Provider($validatedData);
            $provider->update();


            return response()->json([
                'status' => true,
                'message' => "successfully update"
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
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return response()->json([
            'status' => true,
            'message' => "successfully provider delete"
        ], 200);
    }
}
