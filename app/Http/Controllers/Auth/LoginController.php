<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function redirectToLinkedin()
    {
        return Socialite::driver('linkedin')->redirect();
    }
    public function handleLinkedinCallback()
    {

        try {
            $user = Socialite::driver('linkedin')->user();

            if (count(DB::table('users')->where('email', $user->email)->get()) == 1) {
                $userdata = User::where('email', $user->email)->first();
                Auth::login($userdata);
                return redirect('/admin');
            } else {
                $usersave = new User;
                $usersave->user_id = rand();
                $usersave->name = $user->first_name;
                $usersave->last = $user->last_name;
                $usersave->verification_code = $user->token;
                $usersave->email = $user->email;
                $usersave->is_verify = 1;

                $rand = rand();

                if (isset($user->avatar)) {
                    $url = $user->avatar;
                    $img = public_path('userprofil') . "/$rand.jpeg";
                    file_put_contents($img, file_get_contents($url));
                    $usersave->profil = $rand . "." . "jpeg";
                } else {
                    $usersave->profil = "profil.png";
                }

                $usersave->save();

                Auth::login($usersave);
                return redirect('/admin');
            }
        } catch (\Throwable $th) {
            $report_id = new Report;
            $report_id->error =  $th->getMessage();
            $report_id->save();
            return redirect('/');
        }
    }
}
