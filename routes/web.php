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


// GET METHOD

Route::get('/posts/', function () {
    return redirect()->route('homepage');
});

Route::get('/posts/{post:uuid}', function (\App\Models\Post $post) {
    return redirect()->route('edit_post', $post->uuid);
});

Route::get('/posts/{post:uuid}/edit', [\App\Http\Controllers\PostController::class, 'edit'])
    ->name('edit_post');


// POST METHOD

Route::post('/posts/store', [\App\Http\Controllers\PostController::class, 'store'])
    ->name('create_post');


// PUT METHOD

Route::put('/posts/{post:uuid}/update', [\App\Http\Controllers\PostController::class, 'update'])
    ->name('update_post');

Route::put('/posts/{post:uuid}/restore', [\App\Http\Controllers\PostController::class, 'restore'])
    ->name('restore_post');


// DELETE METHOD

Route::delete('/posts/{post:uuid}/archive', [\App\Http\Controllers\PostController::class, 'delete'])
    ->withTrashed()
    ->name('archive_post');

Route::delete('/posts/{post:uuid}/force-delete', [\App\Http\Controllers\PostController::class, 'forceDelete'])
    ->withTrashed()
    ->name('forceDelete_post');
