<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //count client , receptionist, managers, floors , rooms
        $managers_count      = User::where('level', 'manager')->get()->count();
        $receptionists_count = User::where('level', 'receptionist')->get()->count();
        $clients_count       = User::where('level', 'client')->get()->count();
        $users_count         = User::where('level','!=','admin')->get()->count();

        return view('dashboard.home', compact('managers_count', 'receptionists_count', 'clients_count', 'users_count'));
    }
}
