<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('team', 'games')->paginate(50);

        return view('app.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('app.users.show', compact('user'));
    }

    public function edit()
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

        return view('app.users.edit',
            compact(
                'medias',
                'chatrooms',
                'requestFriends',
                'requestCanals',
                'friends'
            )
        );
    }

    public function update(UserUpdateRequest $request)
    {
        $validatedData = $request->validated();

        auth()->user()->update([
           'pseudo' => $validatedData['pseudo'],
           'name' => $validatedData['name']
        ]);

        return redirect()->route('user.edit');
    }

    public function changeStatus()
    {
        auth()->user()
            ->status()
            ->update([
                'status_type_id' => \request('status_type_id')
            ]);

        return redirect()->route('homepage');
    }

    public function archive(User $user)
    {
        return false;
    }

    public function restore(User $user)
    {
        return false;
    }
}
