<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class RegistrationController extends Controller
{
    public function create(){
        return view('registration.create');
    }

    public function store(Request $request) {
        $a = 1;
        //validate the form
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
            ]);

        // create and save a user
       $user =  User::create(request(['name', 'email', 'password']));

        // Sign them in
        auth()->login($user);

        //redirect to the home page
        return redirect('/');

    }
}
