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
    public function showSignIn ()
    {
        return view('signIn');
    }

    public function showSignUp ()
    {
        return view('signUp');
    }

    public function signIn (LoginRequest $request)
    {
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

    public function signUp (RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        if ($user) {
            Auth::login($user);
            return view('SignIn');
        }
        $errMsgRegistration = 'Username or password is incorrect';
        return view('signUp')->with('errMsgRegistration', $errMsgRegistration);
    }

    public function changePass (ChangePasswordRequest $request)
    {
        $oldPassword = $request->input('oldPassword');
        $passChange = $request->input('password');
        $passChangeRepeat = $request->input('repeatPasswordChange');

        if (Hash::check($oldPassword, Auth::user()->password)) {
            if ($passChange === $passChangeRepeat) {
                User::where('id', Auth::user()->id)->update([
                    'password' => Hash::make($passChange)
                ]);
                return redirect()->back()->with('passChangeMsgSuccess', 'Password successfully changed');
            } else {
                return redirect()->back()->with('passChangeMsgError', 'Passwords are not matches');
            }
        } else {
            return redirect()->back()->with('passChangeMsgError', 'Old password is not correct');
        }
    }

    public function signOut ()
    {
        Auth::logout();
        return redirect('/all-posts');
    }
}
