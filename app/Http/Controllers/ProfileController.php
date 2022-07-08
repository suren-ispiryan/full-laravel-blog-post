<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;

class ProfileController extends Controller
{
    public function homePage ()
    {
        $data = User::with('posts')
        ->whereHas('followers', function ($query) {
            $query->where('follower_id', Auth::user()->id);
        })
        ->whereDoesntHave('followers', function ($query) {
            $query->where('following_id', Auth::user()->id);
        })->get();
        return view('homePage')->with('blogPosts', $data);
    }

    public function showMyProfile ($id)
    {
        $data = Post::with('user')->where('user_id', $id)->get();
        return view('userProfile')->with('data', $data);
    }

    public function showChosenUserProfile ($id)
    {
        $followings = User::with('following')
        ->whereHas('following',function ($query) {
            $query->where('follower_id', Auth::user()->id);
        })->get();
        if(count($followings)) {
            $followingUsers = [];
            foreach ($followings[0]->following as $following) {
                array_push($followingUsers, $following->id);
            }
            $data = Post::with('user')->where('user_id', $id)->get();
            return view('userProfile')->with('data', $data)->with('followingUsers', $followingUsers);
        } else {
            $data = Post::with('user')->where('user_id', $id)->get();
            return view('userProfile')->with('data', $data);
        }
    }

    public function follow ($id)
    {
        Auth::user()->following()->withTimestamps()->attach($id);
        return redirect()->back();
    }

    public function unfollow ($id)
    {
        Auth::user()->following()->detach($id);
        return redirect()->back();
    }

    public function showPostDetails ($id)
    {
        $data = Post::with('comments')->where('id', $id)->get();
        if (count($data)) {
            $comments = [];
            foreach ($data[0]->comments as $commentList) {
                array_push($comments, $commentList);
            }
            $likes = Like::where('likeable_type', Comment::class)->where('user_id', Auth::user()->id)->get();
            $likeIds = [];
            foreach ($likes as $like) {
                array_push($likeIds, $like->likeable_id);
            }

            $postAllData = Post::with('user')->where('id', $id)->get();
            return view('postDetails')
                 ->with('postData', $postAllData)
                 ->with('comments', $comments)
                 ->with('likeIds', $likeIds);
        } else {
            $postAllData = Post::with('user')->where('id', $id)->get();
            return view('postDetails')->with('postData', $postAllData);
        }
    }

    public function createComment (Request $request, $id)
    {
        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'post_id' => $id,
            'comment' => $request->comment
        ]);
        if ($comment) {
            return redirect('/post-details/'.$id);
        } else {
            abort(403);
        }
    }

    public function showUpdateComment ($id)
    {
        $comment = Comment::where('id', $id)->first();
        return view('editComment')->with('comment', $comment);
    }

    public function updateComment (Request  $request, $id) {
        Comment::where('id', $id)->update(['comment' => $request->commentEdit]);
        $postId = Comment::with('post')->where('id', $id)->first();
        return redirect('/post-details/'.$postId->post_id);
    }

    public function deleteComment ($id)
    {
        Comment::where('id', $id)->delete();
        return redirect()->back();
    }
}
