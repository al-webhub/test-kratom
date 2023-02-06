<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;

use Laravel\Socialite\Facades\Socialite;

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
	
	
	public function getUser(Request $request){		
		$profile = Auth::guard('profile')->user();
    return response()->json($profile);
    //return $request->user();
	}

  public function callback(Request $request, $service) {
    
    $user_data = Socialite::driver($service)->stateless()->user();
    
    \Log::info(print_r($user_data, true));

    $fullname = explode(' ', $user_data->getName());
      
    $user = Profile::firstOrCreate(
      [
        'email' => $user_data->getEmail()
      ],
      [
        'login' => $user_data->getEmail(),
        'firstname' => $fullname[0] ?? '',
        'lastname' => $fullname[1] ?? '',
        'email' => $user_data->getEmail(),
        'photo' => $user_data->getAvatar(),
        'password' => Hash::make(random_bytes(6)),
        'email_verified_at' => now(),
        'referrer_code' => Str::random(8)
      ]
    );
    
    // $token = $user->tokens()->where('name', $service)->first();
    
    // if(!$token)
    //   $token = $user->createToken($service);
  
    // return $token->plainTextToken;


    return $user;
  }

  public function redirect($service) {   
    $url = Socialite::driver($service)->redirect()->getTargetUrl();
    return $url;
  }
}
