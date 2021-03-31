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
            'colors'  => ['rgb(' . rand(0,255) . ',' . rand(0,255) . ','  . rand(0,255) . ')','blue'],
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

        
        $colors_array = array();

        for($i = 0 ; $i < $test->count() ; $i++){
            $colors_array[] = 'rgb(' . rand(0,255) . ',' . rand(0,255) . ','  . rand(0,255) . ')';
        }
        

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
            'colors'  =>

            
            // ['gray','blue','yellow']
            $colors_array
            
            
            ,
            'labels'  => $C,
            'data'    => $v
        ];
        return $data;
    }
}
