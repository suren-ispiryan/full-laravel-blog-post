<?php

namespace App\Http\Controllers;

// Requests
use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
// Facades
use Illuminate\Support\Facades\Auth;
// Models
use App\Models\Post;
use App\Models\User;
use App\Models\Liked;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function showAllPosts () {
        $allPosts = Post::with('user')->get();
        return view('allPosts')->with('allPosts', $allPosts);
    }

    public function showAuthUserPosts () {
        $authUserPosts = User::find(Auth::user()->id)->Posts;
        return view('myPosts')->with('authUserPosts', $authUserPosts);
    }

    public function createPost () {
        return view('create');
    }

    public function create (CreatePostRequest $request) {
        $post = Post::create([
            'user_id' => Auth::user()->id,
            'heading' => $request->heading,
            'content' => $request->content
        ]);
        if ($post) {
            $successMsg = 'Post was successfully created';
            return view('create')->with('successMsg', $successMsg);
        }
        else {
            $successMsg = 'Something went wrong';
            return view('create')->with('successMsg', $successMsg);
        }
    }

    public function updatePost ($id) {
        $updatedPost = Post::where('id', $id)->first();
        return view('update')->with('updatedPost', $updatedPost);
    }

    public function update (UpdatePostRequest $request, $id) {
        $updatedPost = Post::where('id', $id)->update([
            'heading' => $request->heading,
            'content' => $request->content
        ]);
        if ($updatedPost) {
            $authUserPosts = User::find(Auth::user()->id)->Posts;
            $successMsg = 'Post was successfully updated';
            return redirect('/auth-user-posts')->with('successMsg', $successMsg)->with('authUserPosts', $authUserPosts);
        }
        else {
            $successMsg = 'Something went wrong';
            return view('update')->with('successMsg', $successMsg);
        }
    }

    public function deletePost ($id) {
        Post::where('id', $id)->delete();
        return redirect('/auth-user-posts');
    }

    public function likePost ($id) {
        $postId = $id;
        $userId = Auth::user()->id;
        $likedExist = Liked::where('post_id', $postId)->where('user_id', $userId)->first();
        if (! $likedExist) {
            Liked::create([
                'post_id' => $postId,
                'user_id' => $userId
            ]);
        }
        return redirect()->back();
    }

    public function showLikedPosts () {
        $user = User::with( 'likedPosts')->where('id', Auth::user()->id)->first(); // object
        return view('likedPosts')->with('LikedPosts', $user->likedPosts);
    }

    public function unLikePost ($id) {
        $postId = $id;
        Liked::where('post_id', $postId)->where('user_id', Auth::user()->id)->delete();
        return redirect()->back();
    }
}
