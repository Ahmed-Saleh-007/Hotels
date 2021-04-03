<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect_to_google() 
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback_from_google() 
    {
        $user = Socialite::driver('google')->stateless()->user();
        $newUser = User::where('email', $user->email)->first();
        if(!$newUser) {
            $newUser = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'password' => Hash::make(123456),
            ]);

            return redirect()->route('site.pending');
            
        }else{

            if($newUser->is_approved == 1)
            { 
                Auth::login($newUser, true);
                return redirect()->route('dashboard.home');


            }else{
                return redirect()->route('site.pending');
            }

        }
    }

    
}
