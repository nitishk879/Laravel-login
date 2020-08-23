<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Notifications\UserRegistration;
use App\Providers\RouteServiceProvider;
use App\Role;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'username';
    }
    /**
     * Redirect the user to the GitHub authentication page.
     * @param $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     * @param $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if($provider=='github'){
            $socialUser = Socialite::driver($provider)->user();
        }else{
            $socialUser = Socialite::driver($provider)->stateless()->user();
        }

        $user = User::where('provider_id', $socialUser->getId())->where('provider', $provider)
            ->orWhere('username', $socialUser->getNickname()  ?? strstr($socialUser->getEmail(), '@', true))
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if(!$user){
            $user = User::updateOrCreate([
                // All Providers
                'provider_id'   =>    $socialUser->getId(),
                'username'      =>    $socialUser->getNickname() ?? strstr($socialUser->getEmail(), '@', true),
                'name'          =>    $socialUser->getName(),
                'email'         =>    $socialUser->getEmail(),
                'provider'      =>    $provider,
                 'avatar'       =>    $socialUser->getAvatar(),
            ]);

            $firstUser = User::count();

            if ($firstUser===0){
                $role = Role::firstOrCreate(['name'=>'admin']);
                $user->roles()->attach($role);
            }
            else{
                $role = Role::firstOrCreate(['name'=>'user']);
                $user->roles()->attach($role);
            }

            $user->notify((new UserRegistration($user)));
        }

        // $user->token;
        Auth::login($user, true);

        return redirect($this->redirectTo)->with("success", "You've logged in successfully.");
    }
}
