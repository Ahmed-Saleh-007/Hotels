<?php

namespace App\Http\Controllers;

use App\Mail\UserResetPassword;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
class UserAuthentication extends Controller
{

    public function login(){

        return view('dashboard.auth.login');

    }

    public function dologin(Request $request){

        $request->validate([
            'email'     => 'required',
            'password'  => 'required'
        ]);
        
        $rememberme = $request->rememberme == 1 ? true : false;

        $user = User::where('email', $request->email)->first();

        if( !empty($user) && $user->is_banned == 1){

            return redirect()->route('site.banning');

        }
        else{
            if (Auth::attempt(['email' => $request->email , 'password' => $request->password], $rememberme)) {
                
                $user->update(['last_login' => now()]);

                if ($user->is_approved == 0 && $user->level == 'client') {
                    session()->flash('success', trans('admin.you_are_not_approved_yet'));
                    return redirect()->route('dashboard.login');
                } else {
                    return redirect('/');
                }
            } else {
                session()->flash('error', trans('admin.invalid_email_or_password'));
                return redirect()->route('dashboard.login');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
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

            Mail::to($admin->email)->send(new UserResetPassword(['data' => $admin , 'token' => $token]));
            
            session()->flash('success', trans('admin.the_reset_link_sent_successfully'));

            return back();

        }

        session()->flash('error', trans('admin.invalid_email'));

        return back();

    }

    public function reset_password($token)
    {
        
        $check_token = DB::table('password_resets')
                        ->where('token', $token)
                        ->where('created_at', '>', Carbon::now()->subHours(2))   //if the token was created at least 2 hours before  
                        ->first();

        if (!empty($check_token))
        {

            return view('dashboard.auth.reset_password', ['data' => $check_token]);

        } else {

            return redirect()->route('dashboard.reset_password');

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

            $admin = User::where('email', $check_token->email)->update([
                'email' => $check_token->email,
                'password'  => bcrypt(request('password'))
            ]);

            //delete all records which is related to this email
            DB::table('password_resets')->where('email', $check_token->email)->delete();

            //auto login after reseting password
            Auth::attempt(['email' => $check_token->email , 'password' => request('password')], true);

            return redirect('/');
            
        } else {

            return redirect()->route('dashboard.reset_password');

        }

    }

}
