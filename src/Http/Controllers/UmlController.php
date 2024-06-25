<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use MatthewPageUK\LaraVelDevBuddy\Support\Uml\LaravelToUml;

class UmlController extends Controller
{
    public function index() {
        $source = (new LaravelToUml)->create()->getSource();
        return view('lvdb::uml', compact('source'));
    }
}