<?php

namespace App\Http\Controllers\Website\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SocialAccountService;
use Socialite;
use App\User;
use App\CatagoriesType;
use Cart;
use App\News;

class SocialAuthController extends Controller
{
    public function redirect($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function callback($social,Request $request)
    {

        try {

            if($social == "facebook"){
                $data = Socialite::driver('facebook')->stateless()->user();
                if(explode("@", $data->email)[1] !== 'gmail.com'){
                    return redirect()->to('/')->with('error', 'Please use email ending "gmail".');
                }
                $existingUserByMail = User::where('email', $data->email)->first();
                $existingUserByName = User::where('username', $data->name)->first();
                if ($existingUserByMail) {
                    auth()->login($existingUserByMail, true);
                }
                elseif($existingUserByName){
                    auth()->login($existingUserByName, true);
                } else {
                    $user = new User();
                    $user->username = $data->name;
                    $user->name = $data->name;
                    $user->email = $data->email;
                    $user->remember_token = $data->token;
                    $user->save();
                    auth()->login($user,true);
                }
            }elseif($social == "google"){
                $data = Socialite::driver('google')->stateless()->user();
                if(explode("@", $data->email)[1] !== 'gmail.com'){
                    return redirect()->to('/')->with('error', 'Please use email ending "gmail".');
                }
                $existingUserByMail = User::where('email', $data->email)->first();
                $existingUserByName = User::where('username', $data->name)->first();
                if ($existingUserByMail) {
                    auth()->login($existingUserByMail, true);
                }
                elseif($existingUserByName){
                    auth()->login($existingUserByName, true);
                }else {
                    $user = new User();
                    $user->username = $data->name;
                    $user->name = $data->name;
                    $user->email = $data->email;
                    $user->remember_token = $data->token;
                    $user->verified = $data->user['verified_email'];
                    $user->save();
                    auth()->login($user,true);
                }
            }
        } catch (Exception $e) {
            dd($e);
        }
        return redirect()->route('web.homepage');
    }
}
