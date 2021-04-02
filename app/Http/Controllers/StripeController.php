<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use Stripe;
use Session;
use App\DataTables\ReservationDataTable;
use App\Models\Room;

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
            "client_id" => auth()->user()->id,
            "room_id"   => request('room'),
            "country"   => request('country'),
            "acc_no"    => request('acc_no'),
            "from"      => request('from'),
            "to"        => request('to'),
            "price"     => intval(request('totalprice'))*100
        ]);

        $room = Room::find(request('room'))->update(['is_available' => 0 ]);
        Session::flash('success', 'Payment successful!');       
        return redirect()->route('reserv.all');
    }
}