<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

use Laravel\Socialite\Facades\Socialite;
use Laravel\Sanctum\PersonalAccessToken;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;

use App\Models\Override\Profile;

/**
 * @group Auth
 *
 * APIs for authentication
 */
class OAuthController extends Controller
{
		
	private function saveImage($url) {
		$file = file_get_contents($url);
		
		$filename = uniqid() . '.jpg';
    $path = 'uploads/images/' . rand(1, 100) . '/' . rand(1, 100) . '/' . rand(1, 100) . '/' . $filename;
        
    Storage::put($path, $file);

		return $path;
	}
	
	
	public function loginByToken(Request $request){	
    $hashedTooken = $request->token;

    $token = PersonalAccessToken::findToken($hashedTooken);
    $profile = $token->tokenable;

    if($profile) {
      Auth::guard('profile')->login($profile, $remember = true);
      $request->session()->regenerate();
      return response()->json($profile);
    }
    else {
      return response()->json(['error' => 'NO profile']);
    }
	}

  public function callback(Request $request, $service) {
    
    $user_data = Socialite::driver($service)->stateless()->user();
    
    \Log::info(print_r($user_data, true));

    $fullname = explode(' ', $user_data->getName());
    $email = $user_data->getEmail();
    $password = random_bytes(6);
      
    $user = Profile::firstOrCreate(
      [
        'email' => $email
      ],
      [
        'login' => $email,
        'firstname' => $fullname[0] ?? '',
        'lastname' => $fullname[1] ?? '',
        'email' => $email,
        'photo' => $user_data->getAvatar(),
        'password' => Hash::make($password),
        'email_verified_at' => now(),
        'referrer_code' => Str::random(8)
      ]
    );
    
    $user->tokens()->delete();
    $token = $user->createToken($service);

    return redirect(env('FRONT_URL', 'http://localhost:3000') . '?token=' . $token->plainTextToken);
  }

  public function redirect($service) {   
    $url = Socialite::driver($service)->redirect()->getTargetUrl();
    return $url;
  }
}
