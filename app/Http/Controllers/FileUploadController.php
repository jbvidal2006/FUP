<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        // Almacena el archivo en el directorio 'image' dentro del disco 'public'
        $path = $request->file('file')->store('image', 'public');

        // Construye la URL absoluta del archivo
        // Asume que tu aplicación está servida desde la raíz ('/') y que los archivos estáticos están en 'public'
        $url = url($path);

        return response()->json(['data' => $url]);
    }

    public function imagenID($urlImage)
    {
        $absoluteUrl = Storage::url($urlImage);

        // Obtiene el nombre del archivo
        $absoluteUrl = basename($absoluteUrl);

        // Devuelve la URL absoluta y el nombre del archivo en la respuesta JSON
        return response()->json([
            'linkImage' => $absoluteUrl
        ]);
    }
}


