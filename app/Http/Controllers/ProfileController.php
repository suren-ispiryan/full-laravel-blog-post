<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Facades
use Illuminate\Support\Facades\Auth;
// Models
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    public function homePage () {
        return view('homePage');
    }

    public function showMyProfile ($id) {
        $data = Post::with('user')->where('user_id', $id)->get();
        return view('userProfile')->with('data', $data);
    }

    public function showChosenUserProfile ($id) {
        $data = Post::with('user')->where('user_id', $id)->get();
        return view('userProfile')->with('data', $data);
    }

    public function follow ($id) {
        return redirect()->back();
    }
}
