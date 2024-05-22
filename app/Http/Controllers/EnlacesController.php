<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\User;

class EnlacesController extends Controller
{
    //metodos extra

    public function joinProvPeo()
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

        //po
    public function joinProvedorpeopleID($id)
    {
        // Realiza un inner join entre las tablas Provider y People
        $join = People::join('providers', 'people.id', '=', 'providers.people_peo_id')
            ->where('people.id', '=', $id )
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


    public function joinUserPeople($id)
    {
        // Realiza un inner join entre las tablas Provider y People
        $join = People::join('users', 'people.id', '=', 'users.people_id')
            ->where('users.id', '=', $id )
            ->select([
                '*',
                'people.id as people_id',
                'users.id as users_id'

            ])
            ->get();

        $data = [
            'status' => true,
            'data' => $join
        ];

        return response()->json($data);
    }


    public function joinProdProvPers()
    {
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



    public function joinProdProvPeopleID($id)
    {

        $join = Provider::join('products', 'products.providers_id', '=', 'providers.id')
            ->join('people', 'people.id', '=', 'providers.people_peo_id')
            ->where('people.id', '=', $id)
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

    public function joinReqPeoUsu($id)
    {

        $join = User::join('people', 'users.people_id', '=', 'people.id')
            ->join('request_apps', 'people.id', '=', 'request_apps.people_id')
            ->where('users.id', '=', $id)
            ->select([
                'request_apps.req_type' ,
                'people.peo_phone',
                'people.peo_name',
                'people.peo_lastname',
                'people.peo_adress',
                'users.use_rol',
                'request_apps.req_status',
                'people.id as people_id',
                'request_apps.id as provider_id',
                'users.id as users_id'

            ])
            ->get();

            $data = [
                'status' => true,
                'data' => $join
            ];

            return response()->json($data);
    }

        //mostrar info reques people users
    public function showReqPeoUsu()
    {

        $join = User::join('people', 'users.people_id', '=', 'people.id')
            ->join('request_apps', 'people.id', '=', 'request_apps.people_id')
            ->select([
                'request_apps.req_type' ,
                'request_apps.req_dateRequest',
                'people.peo_phone',
                'people.peo_name',
                'people.peo_lastname',
                'people.peo_adress',
                'users.use_rol',
                'request_apps.req_status',
                'people.id as people_id',
                'request_apps.id as provider_id',
                'users.id as users_id'

            ])
            ->get();

            $data = [
                'status' => true,
                'data' => $join
            ];

            return response()->json($data);
    }

}
