<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ChangePasswordRequest;

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
            $data = Post::whereHas('likes', function($query) {
                $query->where('user_id', Auth::user()->id);
            })->get();
            if (count($data)) {
                $liked_ids = [];
                foreach ($data as $post) {
                    array_push($liked_ids, $post->id);
                }
                $allPosts = Post::with('user')->get();
                return view('allPosts')->with('allPosts', $allPosts)->with('liked_ids', $liked_ids);
            } else {
                $liked_ids = [];
                $allPosts = Post::with('user')->get();
                return view('allPosts')->with('allPosts', $allPosts)->with('liked_ids', $liked_ids);
            }
        }
        return view('signIn')->with('errLogin', 'Username or password is incorrect');
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
        return view('signUp')->with('errMsgRegistration', 'Username or password is incorrect');
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
