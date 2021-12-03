<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionsController extends Controller
{
    //
    public function create() {
        return view('sessions.create');
    }

    public function store() {
        // ddd(request()->all());
        // validate the request
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        // attempt to authenticate and log in the user
        // based on the provided credentials
        if (auth()->attempt($attributes)) {
            return redirect('/');
        }

        throw ValidationException::withMessages([
            'email' => 'Your provided credentials could not be verified.'
        ]);

        // return back()->withErrors(['email' => 'Your provided credentials could not be verified.']);
        // redirect with a success flash message
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/');
    }
}
