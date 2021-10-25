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
        $users = User::all();

        $friendsList = $user->getAcceptedFriendships();
        $friends = $friendsList->map(function ($friend) use ($user, $users) {
            if ($friend->sender_id === $user->id) {
                return $users->find($friend->recipient_id);
            } elseif($friend->recipient_id === $user->id) {
                return $users->find($friend->sender_id);
            } else {
                return false;
            }
        });

        return view('app.home.index');
    }
}
