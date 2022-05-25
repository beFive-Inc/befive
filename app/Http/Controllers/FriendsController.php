<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FriendsController extends Controller
{

    public function index()
    {
        $friends = \Auth::user()->getFriends()->load('status');

        return view('app.friends.index', compact('friends'));
    }
}
