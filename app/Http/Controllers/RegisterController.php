<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function create() 
    {
        return view('register.create');
    }

    public function store()
    {
    //    ddd(request()->all());
        // create the user
        $attributes = request() -> validate([
            'name' => 'required|max:255',
            'username' => 'required|max:255|min:3',
            'email' => 'required|email|max:255',
            'password' => 'required|min:7|max:255'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        // log the user in
        auth()->login($user);

        return redirect('/');
    }

}
