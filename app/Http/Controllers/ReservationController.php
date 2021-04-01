<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\DataTables\ReservationDataTable;

class ReservationController extends Controller
{
    public function index(ReservationDatatable $reserv_data) {
        $contries_info = countries();

        $countries_names = array();

        foreach($contries_info as $country){

            $countries_names[$country['name']] = $country['name'];

        }
        return $reserv_data->render('reservations.index',['countries' => $countries_names]);
    }

    public function show(Reservation $reserv) {
        return view('reservations.ajax_show', compact('reserv'));
    }

    public function book(Request $request) {
        

        $contries_info = countries();

        $countries_names = array();

        foreach($contries_info as $country){

            $countries_names[$country['name']] = $country['name'];

        }
        return view('payments.book', ['countries' => $countries_names]);
    }

    public function cancel(Reservation $reserv) {
        $reserv->delete();
        return response()->json(['success' => trans('admin.deleted_record')]);
    }
}