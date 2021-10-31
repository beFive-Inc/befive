<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $friends = $user->getFriends();

        $posts = $user->getPostsForMe(5);

        return view('app.home.index', compact('friends', 'posts'));
    }
}
