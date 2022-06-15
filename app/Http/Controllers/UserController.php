<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserUpdateRequest;
use App\Models\StatusType;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('team', 'games')->paginate(50);

        return view('app.user.index', compact('users'));
    }

    public function status()
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

        $types = StatusType::all();

        return view(
            'app.user.status',
            compact(
                'chatrooms',
                'requestFriends',
                'requestCanals',
                'friends',
                'types',
                'medias'
            )
        );
    }

    public function show(User $user)
    {
        return view('app.user.show', compact('user'));
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

        return view('app.user.edit',
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

        if ($request->hasFile('profile')) {
            auth()->user()
                ->addMediaFromRequest('profile')
                ->toMediaCollection('profile');
        }

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
                'message' => \request('status-name'),
                'status_type_id' => \request('type')
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
