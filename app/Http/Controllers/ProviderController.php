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
        $provider = provider::where('prov_status', 1)->get();
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
            $validatedData = $request->validate([
                'prov_ranking' => 'required|integer',
                'prov_group' => 'required|string',
                'prov_description' => 'required|string',
                'prov_status' => 'required',
                'people_peo_id' => 'required'
            ]);

            $provider->update($validatedData);


            return response()->json([
                'status' => true,
                'message' => "successfully update",
                "data" => $provider
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }
    }

    public function updateOnlyRanking(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'prov_ranking' => 'required|integer',
            ]);

            $provider = Provider::findOrFail($id);
            $provider->update(['prov_ranking' => $validatedData['prov_ranking']]);

            return response()->json([
                'status' => true,
                'message' => "Successfully updated ranking",
                "data" => $provider
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'errors' => ['provider_not_found' => 'The provider was not found.']
            ], 404);
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
        $provider->update(['prov_status' => 0]);

        return response()->json([
            'status' => true,
            'message' => "successfully provider 'delete' "
        ], 200);
    }
}
