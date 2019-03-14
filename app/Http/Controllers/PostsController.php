<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $users = User::query()->limit(4)->get();

        $users = $users->map(function ($user) {
            //可以考虑$user->id缓存,在保证了速度的同时避免大面积的缓存重建
            $user->posts = $user->posts()->limit(3)->get();

            return $user;
        });


        dd($users);
    }

    public function getAll()
    {
       //all
        $arr = [1,2,3];

        //dd(collect($arr));

        //avg
        dd(collect($arr)->avg());

    }
}
