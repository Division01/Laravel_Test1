<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store()
    {
        //dd - die dump will kill the page and anything you put in it
        dd('abc');

        //validation
        //store user
        // sign the user in
        //redirect
    }
}
