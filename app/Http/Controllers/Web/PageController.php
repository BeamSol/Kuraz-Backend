<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    public function login() {
        return view('pages.login');
    }

    public function register() {
        return view('pages.register');
    }

    public function dashboard() {
        return view('pages.dashboard');
    }
}
