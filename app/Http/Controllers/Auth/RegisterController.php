<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'         => ['required', 'string', 'max:255'],
            'avatar_image' => ['required', 'image', 'mimes:jpeg,jpg'],
            'country'      => ['required'],
            'gender'       => ['required', 'in:male,female'],
            'email'        => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'     => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        if(request()->hasFile('avatar_image')){

            $data['avatar_image'] = rand() . '.' . request()->avatar_image->getClientOriginalExtension();
            request()->avatar_image->storeAs('users_images', $data['avatar_image']);

        }

        return User::create([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'level'        => 'client',
            'country'      => $data['country'],
            'gender'       => $data['gender'],
            'avatar_image' => $data['avatar_image'],
            'password'     => Hash::make($data['password']),
            
        ]);

        session()->flash('success' , 'Account registered successfully, we will send approved message to you soon');

        return back();

    }
}
