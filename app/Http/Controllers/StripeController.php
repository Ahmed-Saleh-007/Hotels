<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe;
use Session;
use App\DataTables\ReservationDataTable;

class StripeController extends Controller
{
    /**
      * success response method.
      *
      * @return \Illuminate\Http\Response
      */
    public function stripe(Request $request)
    {
        $data = $request->validate([
            'country'     => 'required',
            'acc_no'      => 'required',
            'room'        => 'required',
            'from'        => 'required',
            'to'          => 'required|after:from',
        ]);
        return view('payments.payments',compact('data'));
    }
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {  
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
                "amount" => floatval(request('totalprice')),
                "currency" => "usd",
                "source" => $request->stripeToken,
        ]);

        Reservation::create ([
            "client_id" => 1,
            "room_id"   => 1,
            "country"   => request('country'),
            "acc_no"    => request('acc_no'),
            "from"      => request('from'),
            "to"        => request('to'),
            "price"     => intval(request('totalprice'))*100
        ]);

        Session::flash('success', 'Payment successful!');
       
        return redirect()->route('reserv.all');
    }
}