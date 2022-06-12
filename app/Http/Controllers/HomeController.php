<?php

namespace App\Http\Controllers;

use App\Events\FriendAdded;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class HomeController extends Controller
{
    public function index()
    {
        $medias = auth()->user()
            ->load('media')
            ->media;

        $chatrooms = auth()->user()
            ->getChatrooms();

        $requestCanals = auth()->user()
            ->getRequestedCanals();

        $requestFriends = auth()->user()
            ->getFriendRequests()
            ->map(function ($user) {
                return User::find($user->sender_id);
            });

        $friends = auth()->user()
            ->getFriends()
            ->load('media');

        return view(
            'app.home.index',
            compact(
                'chatrooms',
                'requestFriends',
                'requestCanals',
                'friends',
                'medias'
            )
        );
    }

    public function menu()
    {
        $medias = auth()->user()
            ->load('media')
            ->media;

        $chatrooms = auth()->user()
            ->getChatrooms();

        $requestCanals = auth()->user()
            ->getRequestedCanals();

        $requestFriends = auth()->user()
            ->getFriendRequests()
            ->map(function ($user) {
                return User::find($user->sender_id);
            });

        $friends = auth()->user()
            ->getFriends()
            ->load('media');

        return view(
            'app.home.menu',
            compact(
                'chatrooms',
                'requestFriends',
                'requestCanals',
                'friends',
                'medias'
            )
        );
    }
}
