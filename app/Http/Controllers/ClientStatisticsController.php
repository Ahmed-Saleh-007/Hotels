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

        $users =  User::select(DB::raw("COUNT(*) as count,gender as gender"))
        ->where('level', 'client')
        ->groupBy('gender')
        ->pluck('count', 'gender');
        
        $users = json_decode($users);

        $data = array();

        $labels    = array();
        $content    = array();

        foreach ($users as $key => $value) {
            $labels[] = $key;
            $content[] = $value;
        }

        $data = [
            'id'      => 'myChart',
            'colors'  => ['rgb(' . rand(0,255) . ',' . rand(0,255) . ','  . rand(0,255) . ')','blue'],
            'labels'  => $labels,
            'data'    => $content
        ];

        return $data;

    }//end of client data function

    public function countryData()
    {

        $users =  User::select(DB::raw("COUNT(*) as count,country as country"))
        ->where('level', 'client')
        ->groupBy('country')
        ->pluck('count', 'country');

        $colors_array = array();

        for($i = 0 ; $i < $users->count() ; $i++){
            $colors_array[] = 'rgb(' . rand(0,255) . ',' . rand(0,255) . ','  . rand(0,255) . ')';
        }

        $users = json_decode($users);

        $data = array();

        $labels  = array();
        $content = array();

        foreach ($users as $key => $value) {
            $labels[]  = $key;
            $content[] = $value;
        }

        $data = [
            'id'      => 'myChart_1',
            'colors'  => $colors_array,
            'labels'  => $labels,
            'data'    => $content
        ];

        return $data;

    }//end of country data function

}//end of controller
