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
    ->middleware('auth');


////
// REGISTER STEP ROUTE
////

Route::prefix('steps')->middleware('auth')->name('step.')->group(function () {

    // GET METHOD

    Route::get('/', function () {
        return redirect()->route('step.first');
    });

    Route::get('/first', [\App\Http\Controllers\RegisterStepController::class, 'firstStepview'])
        ->name('first');


    // POST METHOD

    Route::post('/first/store', [\App\Http\Controllers\RegisterStepController::class, 'firstStepstore'])
        ->name('first.store');


    // PUT METHOD


    // DELETE METHOD
});


////
// ALL POSTS ROUTE
////

Route::prefix('posts')->middleware('auth')->name('post.')->group(function () {

    // GET METHOD

    Route::get('/', function () {
        return redirect()->route('homepage');
    });

    Route::get('/{post:uuid}', function (\App\Models\Post $post) {
        return redirect()->route('post.edit', $post->uuid);
    });

    Route::get('/{post:uuid}/edit', [\App\Http\Controllers\PostController::class, 'edit'])
        ->name('edit');


    // POST METHOD

    Route::post('/store', [\App\Http\Controllers\PostController::class, 'store'])
        ->name('create');


    // PUT METHOD

    Route::put('/{post:uuid}/update', [\App\Http\Controllers\PostController::class, 'update'])
        ->name('update');

    Route::put('/{post:uuid}/restore', [\App\Http\Controllers\PostController::class, 'restore'])
        ->name('restore');


    // DELETE METHOD

    Route::delete('/{post:uuid}/archive', [\App\Http\Controllers\PostController::class, 'archive'])
        ->withTrashed()
        ->name('archive');

    Route::delete('/{post:uuid}/force-delete', [\App\Http\Controllers\PostController::class, 'forceDelete'])
        ->withTrashed()
        ->name('forceDelete');
});



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

    Route::delete('/{post:slug}/delete', [\App\Http\Controllers\UserController::class, 'delete'])
        ->withTrashed()
        ->name('delete');
});

