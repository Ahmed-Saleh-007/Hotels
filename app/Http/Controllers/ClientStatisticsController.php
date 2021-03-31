<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientStatisticsController extends Controller
{
    public function index()
    {
        return view('clients.statistics');
    }

    public function clientData()
    {
        $test =  User::select(DB::raw("COUNT(*) as count,gender as gender"))
        ->where('level', 'client')
        ->groupBy('gender')
        ->pluck('count', 'gender');
        
        $test = json_decode($test);
        $data = array();
        $C = array();
        $v = array();
        foreach ($test as $key => $value) {
            $C[] = $key;
            $v[] = $value;
        }

        $data = [
            'id'      => 'myChart',
            'colors'  => ['black','blue'],
            'labels'  => $C,
            'data'   => $v
        ];
        return $data;
    }
    


    public function countryData()
    {
        $test =  User::select(DB::raw("COUNT(*) as count,country as country"))
        ->where('level', 'client')
        ->groupBy('country')
        ->pluck('count', 'country');
        
        $test = json_decode($test);

        $data = array();
        $C = array();
        $v = array();
        foreach ($test as $key => $value) {
            $C[] = $key;
            $v[] = $value;
        }

        $data = [
            'id'      => 'myChart_1',
            'colors'  => ['black','blue','yellow'],
            'labels'  => $C,
            'data'   => $v
        ];
        return $data;
    }
}
