<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\UserRequest;
use App\Models\User;

class UsersController extends ApiController
{
    public function store(UserRequest $request)
    {
         User::create([
            'name'     => $request->name,
            'password' => bcrypt($request->password),
        ]);

         return response()->json(['msg' => '注册成功'], 200);
    }
}
