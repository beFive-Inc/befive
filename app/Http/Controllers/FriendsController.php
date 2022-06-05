<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Multicaret\Acquaintances\Models\Friendship;

class FriendsController extends Controller
{

    public function index()
    {
        $friends = \Auth::user()->getFriends()->load('status');

        return view('app.friends.index', compact('friends'));
    }

    public function create()
    {
        $friendToAdd = User::where('uuid', '=', \request('uuid'))
            ->first();

        auth()->user()->befriend($friendToAdd);

        return redirect()->route('homepage');
    }

    public function rename()
    {

        return redirect()->route('homepage');
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
