<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{



    public function upload(Request $request)
{
    $request->validate([
        'file' => 'required',
    ]);

    // Guarda el archivo en el directorio 'image' dentro del disco 'public'
    $path = $request->file('file')->store('image', 'public');

    $url = url('storage/image/' . basename($path));

    return response()->json(['data' => $url]);
}

    public function imagenID($urlImage)
    {

        return response()->file(storage_path("app/public/image/$urlImage"));
    }
}
