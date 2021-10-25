<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $friendsList = $user->getAcceptedFriendships();
        $friends = $friendsList->map(function ($friend) use ($user) {
            if ($friend->sender_id === $user->id) {
                return User::find($friend->recipient_id);
            } elseif($friend->recipient_id === $user->id) {
                return User::find($friend->sender_id);
            } else {
                return false;
            }
        });

        return view('app.home.index');
    }
}
