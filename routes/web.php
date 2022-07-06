<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');

    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/todo', [TodoController::class, 'index'])->name('todo');
    Route::post('/todo/store', [TodoController::class, 'store'])->name('todo.store');
    Route::delete('/todo/{todo}', [TodoController::class, 'destroy'])->name('todo.destroy');

    Route::put('/todo/{todo}/changeStatus', [TodoController::class, 'changeStatus'])->name('todo.changeStatus');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});
