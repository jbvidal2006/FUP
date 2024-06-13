<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'cat_name' => 'required|string|max:255',
                'cat_description' => 'string',
                'cat_image' => 'required'

            ]);

            $Category = new Category($validatedData);
            $Category->save();

            return response()->json([
                'status' => true,
                'message' => "User successfully created",
                'data' => $Category
            ], 201);
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
    public function show(Category $category)
    {
        return response()->json(['status' => true, 'data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {
            $validatedData = $request->validate([
                'cat_name' => 'required|string|max:255',
                'cat_description' => 'string',
                'cat_image' => 'required'
            ]);

            $category->update($validatedData);

            return response()->json([
                'status' => true,
                'message' => "User successfully update",
                'data' => $category
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => false,
                'errors' => $e->errors()
            ], 400);
        }
    }


    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'status' => true,
            'message' => "successfully category delete"
        ], 200);
    }


    public function filtroCategoryID($id){

         // Realiza un inner join entre las tablas Provider y People
         $join = Category::join('products', 'products.categories_id', '=', 'categories.id')
         ->join('providers', 'providers.id', '=', 'products.providers_id')
         ->join('people', 'people.id', '=', 'providers.people_peo_id')
         ->join('users', 'users.people_id', '=', 'people.id' )
         ->where('products.pro_status', '=', '1')
         ->where('users.use_status', '=', '1')
         ->where('categories.id', '=', $id)

         ->select([
             '*',
             'people.id as people_id',
             'providers.id as provider_id',
             'products.id as product_id',
             'categories.id as category_id'

         ])
         ->get();


     return response()->json($join);

    }



}
