<?php

namespace App\Http\Controllers;
// Models
use App\Models\User;
// Requests
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ChangePasswordRequest;
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

    public function signIn (LoginRequest $request) {
        $email = $request->email;
        $password = $request->password;
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

    public function signUp (RegisterRequest $request) {
        if ($request->password === $request->reEnterRegisterPassword) {
            $user = User::create($request->toArray());
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

    public function changePass (ChangePasswordRequest $request) {
        $passChange = $request->input('password');
        $passChangeRepeat = $request->input('repeatPasswordChange');
        if ($passChange === $passChangeRepeat) {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make($passChange)
            ]);
            return redirect()->back();
        }
        else {
            return redirect()->back();
        }
    }

    public function signOut(){
        Auth::logout();
        return redirect('/all-posts');
    }
}
