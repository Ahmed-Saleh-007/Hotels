<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $user = Socialite::driver('google')->user();
        $newUser = User::where('email', '=', $user->email)->first();
        if(!$newUser) {
            $newUser = User::create([
                'name'  => $user->name,
                'email' => $user->email,
            ]);
            Auth::login($newUser, true);
            return redirect()->route('dashboard.login');
            
        }else{
            Auth::login($newUser, true);
            return redirect()->route('dashboard.home');
        }
    }

    
}
