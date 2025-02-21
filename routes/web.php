<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect('/users');
});



// passar dentro de um array qual o controlador e a função que será chamada. Fazendo isso pois o controlador não é um invoker.

Route::get('/login', [AuthController::class, 'index'])->name('login');

// informando qual método será chamado no post do /login
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/qualquercoisa/search', [UserController::class, 'buscar'])->name('users.search');
*/

Route::prefix('users')->group(function() {

    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::post('/', [UserController::class, 'store'])->name('users.store');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/search', [UserController::class, 'search'])->name('users.search');
    Route::get('/{user}', [UserController::class, 'show'])->name('users.show');
});



// protegendo as rotas com o middleware auth para somente usuarios autenticados terem acesso
Route::middleware(['auth'])->group(function() {
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});
