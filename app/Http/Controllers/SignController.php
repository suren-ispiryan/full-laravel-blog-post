<?php

namespace App\Http\Controllers;
// Models
use App\Models\User;
// Requests
use Illuminate\Http\Request;
// Facades
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignController extends Controller
{
    public function showSignIn () {
        return view('signIn');
    }

    public function showSignUp () {
        return view('signUp');
    }

    public function signIn (Request $request) {
        $email = $request->loginEmail;
        $password = $request->loginPassword;
        $credentials = [
            'email' => $email,
            'password' => $password
        ];
        if (Auth::attempt($credentials)) {
            return redirect('/all-posts');
        }
        $errLogin = 'Username or password is incorrect';
        return view('signIn')->with('errLogin', $errLogin);
    }

    public function signUp (Request $request) {
        if ($request->registerPassword === $request->reEnterRegisterPassword) {
            $user = User::create([
                'name' => $request->registerFirstName,
                'surname' => $request->registerLastName,
                'email' => $request->registerEmail,
                'password' => Hash::make($request->registerPassword)
            ]);
            if ($user) {
                Auth::login($user);
                return view('SignIn');
            }
        }
        else {
            $errMsgRegistration = 'Username or password is incorrect';
            return view('signUp')->with('errMsgRegistration', $errMsgRegistration);
        }
        return abort(403);
    }

    public function signOut(){
        Auth::logout();
        return redirect('/all-posts');
    }
}
