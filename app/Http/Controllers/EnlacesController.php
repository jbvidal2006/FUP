<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use App\Models\Provider;

class EnlacesController extends Controller
{
    //metodos extra

    public function todoDatosPorIDUser()
    {
        // Realiza un inner join entre las tablas Provider y People
        $join = People::join('users', 'people.id', '=', 'users.people_id')
            ->join('providers', 'people.id', '=', 'providers.people_peo_id')

            ->select([
                '*',
                'users.id as user_id',
                'providers.id as provider_id'

            ])
            ->get();

        $data = [
            'status' => true,
            'data' => $join
        ];

        return response()->json($data);
    }
}
