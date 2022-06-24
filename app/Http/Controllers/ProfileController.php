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
use App\Models\Follow;

class ProfileController extends Controller
{
    public function homePage () {
        $data = User::with('followers')->find(1);
//        dd($data->followers->toArray());
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
}
