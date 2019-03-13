<?php

namespace App\Http\Requests\Api;


use App\Http\Requests\Request;

class UserRequest extends Request
{


    public function rules()
    {
        return [
            'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name',
            'password' => 'required|string|min:6',
            ];
    }

}
