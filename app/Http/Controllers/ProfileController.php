<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Facades
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
// Models
use App\Models\Post;
use App\Models\User;

class ProfileController extends Controller
{
    public function homePage () {
        $data = User::with('posts')
        ->whereHas('followers', function ($query) {
            $query->where('follower_id', Auth::user()->id);
        })
        ->whereDoesntHave('followers', function ($query) {
            $query->where('following_id', Auth::user()->id);
        })->get();
        return view('homePage')->with('blogPosts', $data);
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
        DB::table('follows')->insert(
            array(
                'follower_id' => Auth::user()->id,
                'following_id' => $id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            )
        );
        return redirect()->back();
    }

    public function unfollow ($id) {
        DB::table('follows')
          ->where('follower_id', Auth::user()->id)
          ->where('following_id', $id)
          ->delete();
        return redirect()->back();
    }
}
