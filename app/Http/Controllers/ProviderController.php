<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Contracts\Validation\ValidationRule;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
        $rules = [
            'prov_ranking'=> 'required',
            'prov_imageRanking'=> 'required',
            'prov_email'=> 'required',
            'prov_group'=> 'required',
            'people_peo_id'=> 'required'
        ];
        $validator =  Validator($request->input(),$rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $product = new Provider($request->input());
        $product->save();
        return response()->json([
            'status' => true,
            'message' => "successfully provider create"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        return response()->json(['status'=>true, 'data'=>$provider]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        $rules = [
            'prov_ranking'=> 'required',
            'prov_imageRanking'=> 'required',
            'prov_email'=> 'required',
            'prov_group'=> 'required',
            'people_peo_id'=> 'required'
        ];
        $validator =  Validator($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $provider->update($request->input());
        return response()->json([
            'status' => true,
            'message' => "successfully provider update"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        $provider->delete();
        return response()->json([
            'status'=> true,
            'message'=>"successfully provider delete"
        ],200);
    }



}
