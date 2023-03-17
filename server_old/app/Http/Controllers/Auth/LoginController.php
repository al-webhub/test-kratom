<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Socialite;

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
    private $login_message = 'You have successfully logged in to your account 😊';
    private $register_message = 'You have successfully registered 😊'; 
    

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account/order-history';

    public function redirectToProvider($lang, $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->stateless()->user();
        
        $message = $this->login_message;
        $issetUser = null;
        
        if($user->email)
        	$issetUser = User::where('email', $user->email)->first();
        
        
		if(!$issetUser){
			$issetUser = new User();
			$issetUser->name = $user->nickname? $user->nickname: $user->name;
			$issetUser->email = $user->email;
			$issetUser->password = Hash::make(Str::random(8));
			$issetUser->save();
			
			$issetUser->usermeta->referrer_id = session()->has('ref_id')? session('ref_id'): null;
			$message = $this->register_message;
		}
		
		\Auth::login($issetUser);
        	
        $issetUsermeta = $issetUser->usermeta;
        
        //dd($issetUsermeta);
        if($issetUsermeta){
        	$issetUsermeta->photo = $issetUsermeta->photo? $issetUsermeta->photo: $user->avatar;
			$issetUsermeta->save();
        }
		
		
		return redirect('/')->with('message', $message)->with('type', 'success');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function logout(Request $request){ 
		\Auth::logout();
		return redirect('/');
    }
    
    
    
    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
      if($request->checkout)
      {
        $this->redirectTo = '/checkout';
      }
      
        //$this->validateLogin($request);
         $validator = Validator::make($request->all(), [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
        
        if($validator->fails()) {
            return redirect('checkout#login')
                        ->withErrors($validator)
                        ->withInput();
        }
        
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }
    
    
  
    
}
