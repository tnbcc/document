<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function index(Post $post)
    {
//        $comment->content = '我是文章1的第二条评论';
//        $post = Post::find(1);
//        $comment->commentable()->associate($post);
//        $comment->save();
        $posts = $post->with(['comments' => function ($query) {
            $query->where('id', '>', 1);
        }])->where('id', '=', 1)
           ->get()
           ->toArray();
        dd($posts);
    }
}
