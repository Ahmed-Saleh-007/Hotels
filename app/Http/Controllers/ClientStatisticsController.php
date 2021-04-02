<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
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
        $getClientreservations = Reservation::select('client_id')->get();
        $clientIds = array();
        foreach ($getClientreservations as $client) {
            $clientIds [] = $client['client_id'];
        }
    
    
    
        $users =  User::select(DB::raw("COUNT(*) as count,gender as gender"))
        ->whereIn('id', $clientIds)
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
            'colors'  => ['rgb(' . rand(0, 255) . ',' . rand(0, 255) . ','  . rand(0, 255) . ')','blue'],
            'labels'  => $labels,
            'data'    => $content
        ];

        return $data;
    }//end of client data function

    public function countryData()
    {
        $getClientreservations = Reservation::select('client_id')->get();
        $clientIds = array();
        foreach ($getClientreservations as $client) {
            $clientIds [] = $client['client_id'];
        }
    
    
    

        $users =  User::select(DB::raw("COUNT(*) as count,country as country"))
        ->whereIn('id', $clientIds)
        ->whereNotNull('country')
        ->groupBy('country')
        ->pluck('count', 'country');

        $colors_array = array();

        for ($i = 0 ; $i < $users->count() ; $i++) {
            $colors_array[] = 'rgb(' . rand(0, 255) . ',' . rand(0, 255) . ','  . rand(0, 255) . ')';
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

    public function reservationsRevenue()
    {
        $prices = Reservation::select(DB::raw("SUM(price) as price"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(DB::raw("Month(created_at)"))
                    ->pluck('price');

        $months = Reservation::select(DB::raw("Month(created_at) as Month"))
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw("Month(created_at)"))
        ->pluck('Month');
        

        $pricesPerMonth = array(0,0,0,0,0,0,0,0,0,0,0,0);

        foreach ($months as $key => $month) {
            $pricesPerMonth[$month-1] = (int)$prices[$key]/100;
        }
        // dd($prices);
        $max_no = max($pricesPerMonth);
        
        $data = [
            'id'      => 'myChart_2',
            'label'   => 'Profit',
            'labels'  => ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'],
            'data'    => $pricesPerMonth,
            'max'     => $max_no
        ];
        return $data;
    }
}//end of controller
