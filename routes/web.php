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
    ->withTrashed()
    ->middleware(['auth']);

Route::get( '/discover', [\App\Http\Controllers\HomeController::class, 'discover'])
    ->name('discover')
    ->middleware(['auth']);

Route::get( '/menu', [\App\Http\Controllers\HomeController::class, 'menu'])
    ->name('menu')
    ->middleware(['auth']);


Route::prefix('notifications')->middleware('auth')->name('notification.')->group(function () {

    Route::get('/', [\App\Http\Controllers\NotificationController::class, 'index'])
        ->name('index');

    Route::get('/friends', [\App\Http\Controllers\NotificationController::class, 'indexFriends'])
        ->name('friends');

    Route::get('/canals', [\App\Http\Controllers\NotificationController::class, 'indexCanals'])
        ->name('canals');
});


////
// SEARCH ROUTE
////

Route::prefix('search')->middleware('auth')->name('search.')->group(function () {
    Route::get('/', [\App\Http\Controllers\SearchController::class, 'index'])
        ->name('index');

    Route::post('/', [\App\Http\Controllers\SearchController::class, 'store'])
        ->name('store');
});


////
// ALL USERS ROUTE
////

Route::prefix('user')->middleware('auth')->name('user.')->group(function () {

    // GET METHOD

    Route::get('/', [\App\Http\Controllers\UserController::class ,'index'])
        ->name('index');

    Route::get('/status', [\App\Http\Controllers\UserController::class, 'status'])
        ->name('status');

    Route::get('/edit', [\App\Http\Controllers\UserController::class, 'edit'])
        ->name('edit');


    // POST METHOD


    // PUT METHOD

    Route::put('/update', [\App\Http\Controllers\UserController::class, 'update'])
        ->name('update');

    Route::put('/change-status', [\App\Http\Controllers\UserController::class, 'changeStatus'])
        ->name('change-status');

    Route::put('/restore', [\App\Http\Controllers\UserController::class, 'restore'])
        ->name('restore');



    // DELETE METHOD

    Route::delete('/delete', [\App\Http\Controllers\UserController::class, 'delete'])
        ->withTrashed()
        ->name('delete');
});


////
// ALL CHATROOM ROUTE
////

Route::prefix('chatroom')->middleware('auth')->name('chatroom.')->group(function () {

    // GET METHOD

    Route::get('/archive', [\App\Http\Controllers\ChatroomController::class, 'indexArchive'])
        ->withTrashed()
        ->name('index.archive');

    Route::get('/create', [\App\Http\Controllers\ChatroomController::class, 'create'])
        ->name('create');

    Route::get('/{chatroom:uuid}', [\App\Http\Controllers\ChatroomController::class, 'show'])
        ->name('show');

    // POST METHOD

    Route::post('/view', [\App\Http\Controllers\ChatroomController::class, 'view'])
        ->name('view');

    Route::post('/message/store', [\App\Http\Controllers\ChatroomController::class, 'messageStore'])
        ->name('message.store');

    Route::post('/join', [\App\Http\Controllers\ChatroomController::class, 'join'])
        ->name('join');

    Route::post('/store', [\App\Http\Controllers\ChatroomController::class, 'store'])
        ->name('store');

    // PUT METHOD

    Route::put('/accept', [\App\Http\Controllers\ChatroomController::class, 'accept'])
        ->name('accept');

    Route::put('/deny', [\App\Http\Controllers\ChatroomController::class, 'deny'])
        ->name('deny');

    Route::put('/author/rename', [\App\Http\Controllers\ChatroomController::class, 'authorRename'])
        ->name('author.rename');

    Route::put('/rename', [\App\Http\Controllers\ChatroomController::class, 'rename'])
        ->name('rename');

    Route::put('/restore', [\App\Http\Controllers\ChatroomController::class, 'restore'])
        ->withTrashed()
        ->name('restore');

    // DELETE METHOD

    Route::delete('/archive', [\App\Http\Controllers\ChatroomController::class, 'archive'])
        ->withTrashed()
        ->name('archive');

    Route::delete('/delete', [\App\Http\Controllers\ChatroomController::class, 'delete'])
        ->withTrashed()
        ->name('delete');
});

////
// ALL FRIENDS ROUTE
////

Route::prefix('friends')->middleware('auth')->name('friends.')->group(function () {

    // GET METHOD

    Route::get('/', [\App\Http\Controllers\FriendsController::class, 'index'])
        ->name('index');


    // POST METHOD

    Route::post('/add', [\App\Http\Controllers\FriendsController::class, 'add'])
        ->name('add');

    // PUT METHOD

    Route::put('/accept', [\App\Http\Controllers\FriendsController::class, 'accept'])
        ->name('accept');

    Route::put('/deny', [\App\Http\Controllers\FriendsController::class, 'deny'])
        ->name('deny');

    Route::put('/rename', [\App\Http\Controllers\FriendsController::class, 'rename'])
        ->name('rename');

    Route::put('/block', [\App\Http\Controllers\FriendsController::class, 'block'])
        ->name('block');

    Route::put('/unblock', [\App\Http\Controllers\FriendsController::class, 'unblock'])
        ->name('unblock');


    // DELETE METHOD

    Route::delete('/delete', [\App\Http\Controllers\FriendsController::class, 'delete'])
        ->name('delete');

});


////
// ALL SETTINGS ROUTE
////
