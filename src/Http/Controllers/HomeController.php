<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('lara-vel-dev-buddy::home');
    }

}