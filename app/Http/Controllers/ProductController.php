<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pro_name' => 'required|string|max:255',
                'pro_type' => 'required|string|max:255',
                'pro_price' => 'required',
                'pro_certs' => 'required|string|max:255',
                'pro_image' => 'required|image',
                'pro_unit' => 'required|string|max:255',
                'pro_status' => 'required',
                'providers_id' => 'required',
                'categories_id' => 'required'
            ]);


            $product = new Product($validatedData);
            $product->save();
            return response()->json([
                'status' => true,
                'message' => "successfully category create"
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }

        /* Tratamiento de la imagen
        if ($request->hasFile("pro_image")) {
            $imagen = $request->file('pro_image');
            $nombreimagen = $imagen->getClientOriginalName();
            $ruta = public_path("/img/productos/");
            $imagen->move($ruta, $nombreimagen);
            $request->merge(['pro_image' => $nombreimagen]);
        }
        */
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return response()->json(['status' => true, 'data' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validatedData = $request->validate([
                'pro_name' => 'required|string|max:255',
                'pro_type' => 'required|string|max:255',
                'pro_price' => 'required',
                'pro_certs' => 'required|string|max:255',
                'pro_image' => 'required|image',
                'pro_unit' => 'required|string|max:255',
                'pro_status' => 'required',
                'providers_id' => 'required',
                'categories_id' => 'required'
            ]);


            $product = new Product($validatedData);
            $product->update();
            return response()->json([
                'status' => true,
                'message' => "successfully category create"
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json([
            'status' => true,
            'message' => "successfully delete product"
        ], 200);
    }
}
