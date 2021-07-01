<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleProviderCallback(Request $request)
    {
        try {
            session()->put('state', $request->input('state'));
            $user = Socialite::driver('google')->user();
            // dd($user);
        } catch (\Exception $e) {
            // dd("err", $e);
            return redirect('/');
        }
        // only allow people with @company.com to login
        if(explode("@", $user->email)[1] !== 'gmail.com'){
            return redirect()->to('/')->with('error', 'Please use email ending "gmail".');
        }
        // check if they're an existing user
        $existingUser = User::where('email', $user->email)->first();
        if($existingUser){
            // log them in
            auth()->login($existingUser, true);
        } else {
            // create a new user
            $newUser                  = new User;
            $newUser->name            = $user->name;
            $newUser->email           = $user->email;
            $newUser->google_id       = $user->id;
            $newUser->avatar          = $user->avatar;
            $newUser->avatar_original = $user->avatar_original;
            $newUser->save();
            auth()->login($newUser, true);
            // dd("save done");
        }

        return redirect()->to('/');
    }
}
