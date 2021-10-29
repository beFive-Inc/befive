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
// ALL POSTS ROUTE
////

Route::prefix('posts')->name('post.')->group(function () {

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

    Route::delete('/{post:uuid}/archive', [\App\Http\Controllers\PostController::class, 'delete'])
        ->withTrashed()
        ->name('archive');

    Route::delete('/{post:uuid}/force-delete', [\App\Http\Controllers\PostController::class, 'forceDelete'])
        ->withTrashed()
        ->name('forceDelete');
});

