<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use Auth;
use App\User;

class SocialController extends Controller
{
    //
    public function redirect($provider)
    {
     return Socialite::driver($provider)->stateless()->redirect();
    }

    public function Callback($provider){
            $userSocial =   Socialite::driver($provider)->stateless()->user();
            $users       =   User::where(['email' => $userSocial->getEmail()])->first();
            if($users){
                        Auth::login($users);
                        return redirect('/');
            }else{
            $user = User::create([
                            'first_name'    => explode(" ", $userSocial->getName())[0],
                            'last_name'     => explode(" ", $userSocial->getName())[1],
                            'email'         => $userSocial->getEmail(),
                            'user_pic'      => $userSocial->getAvatar(),
                            'provider_id'   => $userSocial->getId(),
                            'provider'      => $provider,
                        ]);
            return redirect()->route('home');
            }
        }
}
