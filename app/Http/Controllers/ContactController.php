<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

use Illuminate\Contracts\Validation\Validator;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return response()->json($contacts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'con_shippingDate' => 'required',
            'providers_prov_id' => 'required',
            'products_pro_id' => 'required'
        ];

        $validator =  Validator($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $contact = new Contact($request->input());
        $contact->save();
        return response()->json([
            'status' => true,
            'message' => "successfully contact create"
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return response()->json(['status' => true, 'data' => $contact]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $rules = [
            'con_shippingDate' => 'required',
            'providers_prov_id' => 'required',
            'products_pro_id' => 'required'
        ];
        $validator =  Validator($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $contact->update($request->input());
        return response()->json([
            'status' => true,
            'message' => "successfully contact update"
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json(["status" => true, "message" => "delete contact"], 200);
    }
}
