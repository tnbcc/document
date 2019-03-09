<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index()
    {
        $roleId = Role::query()
            ->where('name', '=', '超级管理员')
            ->orWhere('name', '=', '运营')
            ->pluck('id');
        $user = User::query()->find(1);

        $user->roles()->attach($roleId);

    }

    public function show()
    {
        $user = User::find(1);
        $roles = $user->roles()->get();

        $user = $roles->map(function ($role) use($user) {
            $user->role = $role->name;

            return $user;
        });

        dd($user);
    }
}
