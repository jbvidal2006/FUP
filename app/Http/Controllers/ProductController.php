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
        $rules = [
            'pro_name' => 'required',
            'pro_type' => 'required',
            'pro_amount' => 'required',
            'pro_price' => 'required',
            'pro_image' => 'required',
            'pro_certs' => 'required',
            'categories_cat_id' => 'required'
        ];
        $validator =  Validator($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
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


        $product = new Product($request->input());
        $product->save();
        return response()->json([
            'status' => true,
            'message' => "successfully category create"
        ], 200);
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
        $rules = [
            'pro_name' => 'required',
            'pro_type' => 'required',
            'pro_amount' => 'required',
            'pro_price' => 'required',
            'pro_image' => 'required', //   |mimes:jpeg,png,jpg,gif,svg|max:2048
            'pro_certs' => 'required',
            'categories_cat_id' => 'required'
        ];
        $validator =  Validator($request->input(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()->all()
            ], 400);
        }
        $product->update($request->input());
        return response()->json([
            'status' => true,
            'message' => "successfully update product"
        ], 200);
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
