<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{

  ////////////////////////// google login ////////////////////////// 
  public function google()
  {
    return Socialite::driver('google')->redirect();
  }

  public function googleCallback()
  {
    $user = Socialite::driver('google')->user();
    $this->_loginUserData($user);
    return redirect()->route('website.home')->with('message', 'login successfull');
  }

  ////////////////////////// facebook login ////////////////////////// 
  public function facebook()
  {
    return Socialite::driver('facebook')->redirect();
  }

  public function facebookCallback()
  {
    // dd('here');
    $user = Socialite::driver('facebook')->user();
    dd($user);
    $this->_loginUserData($user);
    return redirect()->route('website.home')->with('message', 'login successfull');
  }

  protected function _loginUserData($data)
  {
    $this->user = $data;

    $userLogin = User::create([
      'provider_id' => $data->id,
      'name' => $data->name,
      'email' => $data->email,
    ]);
    Auth::login($userLogin);
  }
}
