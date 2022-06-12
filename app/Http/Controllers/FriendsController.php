<?php

namespace App\Http\Controllers;

use App\Events\FriendAdded;
use App\Models\User;
use Illuminate\Http\Request;
use Multicaret\Acquaintances\Models\Friendship;

class FriendsController extends Controller
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

        $requestCanals = auth()->user()
            ->getRequestedCanals();

        $friends = \auth()->user()
            ->getFriends()
            ->load('media');


        return view('app.friends.index',
            compact(
                'friends',
                'chatrooms',
                'requestFriends',
                'requestCanals',
                'medias'
            ));
    }

    public function create()
    {
        $friendToAdd = User::where('uuid', '=', \request('uuid'))
            ->first();

        auth()->user()->befriend($friendToAdd);

        broadcast(new FriendAdded($friendToAdd));

        return redirect()->route('homepage');
    }

    public function rename()
    {

        return redirect()->route('homepage');
    }

    public function accept()
    {
        $user = User::where('uuid', '=', \request('uuid'))
            ->first();

        auth()->user()->acceptFriendRequest($user);

        return redirect()->route('notification.friends');
    }

    public function deny()
    {
        $user = User::where('uuid', '=', \request('uuid'))
            ->first();

        auth()->user()->denyFriendRequest($user);

        return redirect()->route('notification.friends');
    }

    public function block()
    {
        $friend = User::where('uuid', '=', \request('uuid'))->first();

        auth()->user()->blockFriend($friend);

        return redirect()->route('homepage');
    }

    public function unblock()
    {
        $friend = User::where('uuid', '=', \request('uuid'))->first();

        auth()->user()->unblockFriend($friend);

        return redirect()->route('homepage');
    }

    public function delete()
    {
        $friend = User::where('uuid', '=', \request('uuid'))->first();

        auth()->user()->unfriend($friend);

        return redirect()->route('homepage');
    }
}
