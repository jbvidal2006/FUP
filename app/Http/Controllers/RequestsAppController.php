<?php

namespace App\Http\Controllers;

use App\Models\RequestApp;
use Illuminate\Http\Request;

class RequestsAppController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $requestApp = RequestApp::where('req_status', 1)->get();
       return response()->json($requestApp);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function contrasena(Request $request){
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'req_dateRequest' => 'required|date',
                'req_type' => 'required|string|max:80',
                'req_description' => 'required',
                'req_status' => 'required',
                'people_id' => 'required|integer'
            ]);

            $provider = new RequestApp($validatedData);
            $provider->save();

            return response()->json([
                'status' => true,
                'message' => "successfully request create"
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }
    }


    public function store(Request $request)
    {
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'req_dateRequest' => 'required|date',
                'req_type' => 'required|string|max:80',
                'req_description' => 'required',
                'req_status' => 'required',
                'people_id' => 'required|integer'
            ]);

            $provider = new RequestApp($validatedData);
            $provider->save();

            return response()->json([
                'status' => true,
                'message' => "successfully request create"
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
    public function show(RequestApp $requestApp)
    {
        return response()->json(['status'=>true, 'data'=>$requestApp]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RequestApp $requestApp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestApp $requestApp)
    {
        try {
            // Validar los datos de entrada
            $validatedData = $request->validate([
                'req_status' => 'required'
            ]);

            $statusUpdate = [
                'req_status' => $validatedData['req_status']
            ];

            // Actualizar solo el estado de la solicitud
            $requestApp->updatePartial($statusUpdate);


            return response()->json([
                'status' => true,
                'message' => "successfully request update"
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
    public function destroy(RequestApp $requestApp)
    {
        $requestApp->update(['req_status' => 0]);

        return response()->json([
            'status' => true,
            'message' => "successfully request 'delete' "
        ], 200);
    }

}
