<?php

namespace App\Http\Controllers;


use App\Models\Phone;
use App\Models\User;

class PhonesController extends Controller
{
    public function index(User $user)
    {
        $user = $user->find(1);

        $phone = new Phone([
            'name' => 'iphone'
        ]);
        $phone->user()->associate($user);
        $phone->save();
    }
}
