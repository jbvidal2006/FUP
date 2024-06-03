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
        $product = product::where('pro_status', 1)->get();

        // Barajamos los productos
        $product->shuffle();
        return response()->json($product);
    }


    //FILTROS

    public function filtrarNombre()
    {
        $product = Product::where('pro_status', 1)->orderBy('name', 'asc')->get();

        return response()->json($product);
    }

    public function filtrarPorPrecioMenorAMayor()
    {
        $product = Product::where('pro_status', 1)->orderBy('price', 'asc')->get();

        return response()->json($product);
    }

    public function filtrarPorPrecioMayorAMenor()
    {
        $product = Product::where('pro_status', 1)->orderBy('price', 'desc')->get();

        return response()->json($product);
    }

    public function filtrarPorCertificado()
    {
        $product = Product::where('pro_status', 1)
            ->where('pro_certs', 'certificado') // Filtramos por productos que están certificados
            ->get();

        return response()->json($product);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'pro_name' => 'required',
                'pro_type' => 'required',
                'pro_price' => 'required',
                'pro_certs' => 'required',
                'pro_image' => 'required',
                'pro_unit' => 'required',
                'pro_description' => 'required',
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
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        return response()->json([$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $validatedData = $request->validate([
                'pro_name' => 'required',
                'pro_type' => 'required',
                'pro_price' => 'required',
                'pro_certs' => 'required',
                'pro_image' => 'required',
                'pro_unit' => 'required',
                'pro_description' => 'required',
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
        $product->update(['pro_status' => 0]);

        return response()->json([
            'status' => true,
            'message' => "successfully product 'delete' "
        ], 200);
    }
}
