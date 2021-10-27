<?php

use Illuminate\Support\Facades\Route;

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



Route::get( '/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('homepage')
    ->middleware('auth');

Route::get('/posts/', function () {
    return redirect()->route('homepage');
});

Route::get('/posts/{post:uuid}', function () {
    return redirect()->route('homepage');
});

Route::get('/posts/{post:uuid}/edit', [\App\Http\Controllers\PostController::class, 'edit'])
    ->name('post_edit');
