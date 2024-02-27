<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Provider;

class EnlacesController extends Controller
{
    //metodos extra

    public function getPeopleProvider()
    {
        // Realiza un inner join entre las tablas Provider y People
        $providers = Provider::join('people', 'providers.people_peo_id', '=', 'people.id')
            ->select([
                'providers.people_peo_id',
                'providers.prov_ranking',
                'people.peo_name',
                'peo_image',
                'peo_adress'
            ])
            ->get();

        return response()->json($providers);
    }

}
