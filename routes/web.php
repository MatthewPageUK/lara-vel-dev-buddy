<?php

use Illuminate\Support\Facades\Route;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\CommandsController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\ControllersController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\EnumsController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\HomeController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\ModelsController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\MiddlewareController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\RoutesController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\UmlController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\ConfigsController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\FactoriesController;
use MatthewPageUK\LaraVelDevBuddy\Http\Controllers\MigrationsController;

Route::prefix('lara-vel-dev-buddy')->group(function () {
    Route::name('lara-vel-dev-buddy.')->group(function () {

        Route::get('/', [HomeController::class, 'index'])->name('home');
        Route::get('/models', [ModelsController::class, 'index'])->name('models.index');
        Route::get('/models/{model}', [ModelsController::class, 'show'])->where('model', '.*')->name('models.show');

        Route::get('/enums', [EnumsController::class, 'index'])->name('enums.index');
        Route::post('/enums/code', [EnumsController::class, 'getCode'])->name('enums.code');
        Route::get('/enums/{enum}', [EnumsController::class, 'show'])->where('enum', '.*')->name('enums.show');

        Route::get('/controllers', [ControllersController::class, 'index'])->name('controllers.index');
        Route::get('/controllers/{controller}', [ControllersController::class, 'show'])->name('controllers.show');

        Route::get('/commands', [CommandsController::class, 'index'])->name('commands.index');
        Route::get('/commands/{controller}', [CommandsController::class, 'show'])->name('commands.show');

        Route::get('/middleware', [MiddlewareController::class, 'index'])->name('middleware.index');
        Route::get('/middleware/{middleware}', [MiddlewareController::class, 'show'])->name('middleware.show');

        Route::get('/routes', [RoutesController::class, 'index'])->name('routes.index');
        Route::get('/routes/{route}', [RoutesController::class, 'show'])->where('route', '.*')->name('routes.show');

        Route::get('/configs', [ConfigsController::class, 'index'])->name('configs.index');
        Route::get('/configs/{route}', [ConfigsController::class, 'show'])->where('config', '.*')->name('configs.show');

        Route::get('/factories', [FactoriesController::class, 'index'])->name('factories.index');
        Route::get('/factories/{controller}', [FactoriesController::class, 'show'])->name('factories.show');

        Route::get('/migrations', [MigrationsController::class, 'index'])->name('migrations.index');
        Route::get('/migrations/{migration}', [MigrationsController::class, 'show'])->name('migrations.show');

        Route::get('/uml', [UmlController::class, 'index'])->name('uml.index');
    });
});
