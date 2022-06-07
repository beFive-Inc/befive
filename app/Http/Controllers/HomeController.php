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

        $requestFriends = auth()->user()
            ->getFriendRequests()
            ->load('media');

        $friends = \auth()->user()
            ->getFriends()
            ->load('media');

        $canals = $chatrooms->filter(function ($chatroom) {
           return $chatroom->isCanal;
        });

        $groups = $chatrooms->filter(function ($chatroom) {
            return $chatroom->isGroup;
        });

        $conversations = $chatrooms->filter(function ($chatroom) {
            return $chatroom->isConversation;
        });

        return view(
            'app.home.index',
            compact(
                'chatrooms',
                'canals',
                'groups',
                'conversations',
                'requestFriends',
                'friends',
                'medias'
            )
        );
    }
}
