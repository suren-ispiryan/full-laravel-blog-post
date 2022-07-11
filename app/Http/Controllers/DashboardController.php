<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class DashboardController extends Controller
{
    public function deletedPosts () {
        $authUserTrashedPosts = Post::where('user_id', Auth::user()->id)->onlyTrashed()->get();
        return view('deletedPosts')->with('authUserTrashedPosts', $authUserTrashedPosts);
    }

    public function deleteForever ($id) {
        Post::where('id', $id)->forceDelete();
        return redirect()->back();
    }

    public function restorePost ($id) {
        Post::where('id', $id)->restore();
        return redirect()->back();
    }

    public function showAllPosts ()
    {
        if (Auth::user()) {
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
        $post = Auth::user()->posts()->create([
            'heading' => $data['heading'],
            'content' => $data['content'],
        ]);
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
        $likedExist = Like::where('likeable_id', $postId)
                          ->where('likeable_type', Post::class)
                          ->where('user_id', Auth::user()->id)
                          ->first();
        if (! $likedExist) {
            Like::create([
                'likeable_id' => $postId,
                'likeable_type' => Post::class,
                'user_id' => $userId
            ]);
        }
        return redirect()->back();
    }

    public function showLikedPosts ()
    {
        $userId = Auth::id();
        $posts = Post::whereHas('likes', function($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();
        return view('likedPosts')->with('LikedPosts', $posts);
    }

    public function unLikePost ($postId)
    {
        Like::where('likeable_id', $postId)
            ->where('likeable_type', Post::class)
            ->where('user_id', Auth::user()->id)
            ->delete();
        return redirect()->back();
    }

    public function likeComment ($commentId)
    {
        $userId = Auth::user()->id;
        $likedExist = Like::where('likeable_id', $commentId)
                          ->where('likeable_type', Comment::class)
                          ->where('user_id', Auth::user()->id)
                          ->first();
        if ($likedExist === null) {
            Like::create([
                'likeable_id' => $commentId,
                'likeable_type' => Comment::class,
                'user_id' => $userId
            ]);
        }
        return redirect()->back();
    }

    public function disLikeComment ($commentId)
    {
        Like::where('likeable_id', $commentId)
            ->where('likeable_type', Comment::class)
            ->where('user_id', Auth::user()->id)
            ->delete();
        return redirect()->back();
    }
}
