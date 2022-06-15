<?php

namespace App\Http\Controllers;

use App\Constant\ChatroomStatus;
use App\Constant\ChatroomType;
use App\Models\Chatroom;
use App\Models\User;

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

    public function discover()
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

        $canals = Chatroom::withCount('authors')
            ->where('type', '=', ChatroomType::CANAL)
            ->where('status', '=', ChatroomStatus::PUBLIC)
            ->orderBy('authors_count', 'desc')
            ->paginate(10);

        $friends = auth()->user()
            ->getFriends()
            ->load('media');

        return view(
            'app.home.discover',
            compact(
                'chatrooms',
                'requestFriends',
                'canals',
                'requestCanals',
                'friends',
                'medias'
            )
        );
    }
}
