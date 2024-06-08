<?php

use Illuminate\Support\Facades\Route;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\HomeController;

Route::get('/lara-vel-dev-buddy', [HomeController::class, 'index'])->name('lara-vel-dev-buddy.home');
