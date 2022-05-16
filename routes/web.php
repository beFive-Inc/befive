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

////
// HOMEPAGE
////

Route::get( '/', [\App\Http\Controllers\HomeController::class, 'index'])
    ->name('homepage')
    ->middleware(['auth']);


////
// ALL USERS ROUTE
////

Route::prefix('users')->middleware('auth')->name('user.')->group(function () {

    // GET METHOD

    Route::get('/', [\App\Http\Controllers\UserController::class ,'index'])
        ->name('index');

    Route::get('/{user:slug}', [\App\Http\Controllers\UserController::class, 'show'])
        ->name('show');

    Route::get('/{user:slug}/edit', [\App\Http\Controllers\UserController::class, 'edit'])
        ->name('edit');


    // POST METHOD


    // PUT METHOD

    Route::put('/{user:slug}/update', [\App\Http\Controllers\UserController::class, 'update'])
        ->name('update');

    Route::put('/{user:slug}/restore', [\App\Http\Controllers\UserController::class, 'restore'])
        ->name('restore');


    // DELETE METHOD

    Route::delete('/{user:slug}/delete', [\App\Http\Controllers\UserController::class, 'delete'])
        ->withTrashed()
        ->name('delete');
});

////
// ALL MESSAGES ROUTE
////

Route::prefix('messages')->middleware('auth')->name('messages.')->group(function () {

});


////
// ALL SETTINGS ROUTE
////
