<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('lvdb::home', [
            'title' => 'Lara Vel Dev Buddy',
            'laravelVersion' => app()->version(),
            'phpVersion' => phpversion(),
            'appName' => config('app.name'),
        ]);
    }
}