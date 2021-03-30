<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Admin;

use App\Mail\AdminResetPassword;
use App\Mail\UserResetPassword;
use App\Models\User;
use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Mail;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Hash;

class UserAuthentication extends Controller
{

    public function login(){

        return view('dashboard.auth.login');

    }

    public function register(){

        return view('dashboard.auth.register');

    }

    public function doregister(RegisterRequest $request){

      
        $data = $request->all();

        if(request()->hasFile('avatar_image')){

            $data['avatar_image'] = rand() . '.' . request()->avatar_image->getClientOriginalExtension();
            request()->avatar_image->storeAs('users_images', $data['avatar_image']);

        }

        User::create([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'level'        => 'client',
            'country'      => $data['country'],
            'gender'       => $data['gender'],
            'avatar_image' => $data['avatar_image'],
            'password'     => Hash::make($data['password']),
            
        ]);

        session()->flash('success' , 'Account registered successfully, we will send approved message to you soon');

        return redirect()->route('dashboard.register');

    }

    public function dologin(Request $request){

        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);

        $rememberme = $request->rememberme == 1 ? true : false;

        if( auth()->attempt(['email' => $request->email , 'password' => $request->password], $rememberme)){

            $user = User::where('email', $request->email)->first();

            if( $user->is_approved == 0 && $user->level == 'client'){

                session()->flash('error', trans('admin.you_are_not_approved_yet'));
                return redirect()->route('dashboard.login');

            }else{

                return redirect('/');

            }

        }else{
            session()->flash('error', trans('admin.invalid_email_or_password'));
            return redirect()->route('dashboard.login');
        }

    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('dashboard.login');
    }//end of logout

    public function forgot_password()
    {

        return view('dashboard.auth.forgot_password');

    }//end of forgot password

    //post forgot password function
    public function forgot_password_post(Request $request)
    {

        $request->validate([ 'email'  => 'required']);

        $admin = User::where('email', $request->email)->first();

        if(!empty($admin)){

            $token = app('auth.password.broker')->createToken($admin);

            $data = DB::table('password_resets')->insert([
                'email'      => $admin->email,
                'token'      => $token,
                'created_at' => Carbon::now()
            ]);

            //sending mail to my gmail (bassamsaad771@gmail.com)
            Mail::to($admin->email)->send(new UserResetPassword(['data' => $admin , 'token' => $token]));
            
            session()->flash('success', trans('admin.the_reset_link_sent_successfully'));

            return back();

        }

        session()->flash('error', trans('admin.invalid_email'));

        return back();

    }

    //does not work
    public function reset_password($token)
    {
        
        $check_token = DB::table('password_resets')
                        ->where('token', $token)
                        ->where('created_at', '>', Carbon::now()->subHours(2))   //if the token was created at least 2 hours before  
                        ->first();

        if (!empty($check_token))
        {
            // dd($check_token);
            return view('dashboard.auth.reset_password', ['data' => $check_token]);

        } else {

            return redirect()->route('forgotpassword');

        }
    }

    public function reset_password_post($token)
    {
        $this->validate(request(),[
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ],[],[
            'password'    => trans('dashboard.admin_password'),
            'password_confirmation'    => trans('dashboard.adimn_password_confirmation'),
        ]);

        $check_token = DB::table('password_resets')
                        ->where('token', $token)
                        ->where('created_at', '>', Carbon::now()->subHours(2))   //if the token was created at least 2 hours before  
                        ->first();


        if (!empty($check_token))
        {

            $admin = Admin::where('email', $check_token->email)->update([
                'email' => $check_token->email,
                'password'  => bcrypt(request('password'))
            ]);

            //delete all records which is related to this email
            DB::table('password_resets')->where('email', $check_token->email)->delete();

            //auto login after reseting password
            admin()->attempt(['email' => $check_token->email , 'password' => request('password')], true);

            return redirect('/dashboard/home');
            
        } else {

            return redirect()->route('forgotpassword');

        }

    }

}
