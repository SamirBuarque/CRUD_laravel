<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', function () {
    return redirect('/users');
});



// passar dentro de um array qual o controlador e a função que será chamada. Fazendo isso pois o controlador não é um invoker.

Route::get('/login', [AuthController::class, 'index'])->name('login');

// informando qual método será chamado no post do /login
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('users/create', [UserController::class, 'create'])->name('users.create');

// middleware para proibir o acesso caso nao seja ADM
Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::prefix('users')->group(function () {
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

// protegendo as rotas com o middleware auth para somente usuarios autenticados terem acesso
Route::middleware(['auth'])->group(function () {
    Route::prefix('users')->group(function () {

        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::post('/', [UserController::class, 'store'])->name('users.store');

        Route::get('/search', [UserController::class, 'search'])->name('users.search');
        Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
        //Route::put('/{user}', [UserController::class, 'update'])->name('users.update');
        //Route::delete('/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        //Route::get('/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    });
});
