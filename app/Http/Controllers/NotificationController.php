<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class NotificationController extends Controller
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
            ->map(function ($user) {
                return User::find($user->sender_id);
            });

        $friends = auth()->user()
            ->getFriends()
            ->load('media');

        $requestCanals = auth()->user()
            ->getRequestedCanals();

        return view('app.notification.index', compact(
            'medias',
            'chatrooms',
            'requestFriends',
            'requestCanals',
            'friends',
        ));
    }
}
