<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $friendsList = User::with('friends')->first()->getAcceptedFriendships();
        $friends = $friendsList->map(function ($friend) {
            return User::where('id', $friend->recipient_id)
                ->get();
        });

        return view('app.home.index');
    }
}
