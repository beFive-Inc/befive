<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use App\Models\Game;
use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {
        $chatrooms = Auth::user()
            ->getGroups();

        return view('app.home.index', compact( 'chatrooms'));
    }
}
