<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Liked;

class DashboardController extends Controller
{
    public function showAllPosts ()
    {
        if (Auth::user()) {
            $data = User::with('likedPosts')
                ->whereHas('posts', function ($query) {
                    $query->where('user_id', Auth::user()->id);
                })
                ->get();
            if (count($data)) {
                $liked_ids = [];
                foreach ($data[0]->likedPosts as $post) {
                    array_push($liked_ids, $post->id);
                }
                $allPosts = Post::with('user')->get();
                return view('allPosts')->with('allPosts', $allPosts)->with('liked_ids', $liked_ids);
            } else {
                $liked_ids = [];
                $allPosts = Post::with('user')->get();
                return view('allPosts')->with('allPosts', $allPosts)->with('liked_ids', $liked_ids);
            }
        } else {
            $allPosts = Post::with('user')->get();
            return view('allPosts')->with('allPosts', $allPosts);
        }

    }

    public function showAuthUserPosts ()
    {
        $authUserPosts = User::find(Auth::user()->id)->posts;
        return view('myPosts')->with('authUserPosts', $authUserPosts);
    }

    public function createPost ()
    {
        return view('create');
    }

    public function create (CreatePostRequest $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $post = Post::create($data);
        if ($post) {
            $successMsg = 'Post was successfully created';
        } else {
            $successMsg = 'Something went wrong';
        }
        return view('create')->with('successMsg', $successMsg);
    }

    public function updatePost ($id)
    {
        $updatedPost = Post::where('id', $id)->first();
        return view('update')->with('updatedPost', $updatedPost);
    }

    public function update (UpdatePostRequest $request, $id)
    {
        $updatedPost = Post::where('id', $id)->update([
            'heading' => $request->postHeading,
            'content' => $request->postContent
        ]);
        if ($updatedPost) {
            $authUserPosts = User::find(Auth::user()->id)->Posts;
            $successMsg = 'Post was successfully updated';
            return redirect('/auth-user-posts')->with('successMsg', $successMsg)->with('authUserPosts', $authUserPosts);
        } else {
            $successMsg = 'Something went wrong';
            return view('update')->with('successMsg', $successMsg);
        }
    }

    public function deletePost ($id)
    {
        Post::where('id', $id)->delete();
        return redirect('/auth-user-posts');
    }

    public function likePost ($postId)
    {
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

    public function showLikedPosts ()
    {
        $user = User::with( 'likedPosts')->where('id', Auth::user()->id)->first();
        return view('likedPosts')->with('LikedPosts', $user->likedPosts);
    }

    public function unLikePost ($postId)
    {
        Liked::where('post_id', $postId)->where('user_id', Auth::user()->id)->delete();
        return redirect()->back();
    }
}
