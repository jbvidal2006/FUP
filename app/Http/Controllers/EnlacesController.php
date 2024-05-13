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
        $join = People::join('providers', 'people.id', '=', 'providers.people_peo_id')

            ->select([
                '*',
                'people.id as people_id',
                'providers.id as provider_id'

            ])
            ->get();

        $data = [
            'status' => true,
            'data' => $join
        ];

        return response()->json($data);
    }


    public function productosProvedoresPernas(){
          // Realiza un inner join entre las tablas Provider y People
          $join = Provider::join('products', 'products.providers_id', '=', 'providers.id')
          ->join('people', 'people.id', '=', 'providers.people_peo_id')

          ->select([
              '*',
              'people.id as people_id',
              'providers.id as provider_id',
              'products.id as product_id'

          ])
          ->get();

      $data = [
          'status' => true,
          'data' => $join
      ];

      return response()->json($data);
    }
}
