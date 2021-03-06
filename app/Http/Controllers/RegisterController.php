<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function create(){

        return view('dashboard.auth.register');

    }//end of create function

    public function store(RegisterRequest $request){

        $data = $request->all();

        User::create([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'level'        => 'client',
            'country'      => $data['country'],
            'gender'       => $data['gender'],
            'password'     => Hash::make($data['password']),
            
        ]);

        return redirect()->route('site.pending');

    }//end of register function

}//end of controller
