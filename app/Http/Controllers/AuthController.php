<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function getHomePage()
    {
        // if (Auth::user()) {
        //     return redirect()->route('ems.dashboard');
        // }
        return Inertia::render('home/Home');
        // return Inertia::render('post/CreatePost');
        // return Inertia::render('post/PostList');
        // return Inertia::render('home/FormPage3');
    }
}
