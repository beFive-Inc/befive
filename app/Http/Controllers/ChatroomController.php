<?php

namespace App\Http\Controllers;

use App\Models\Chatroom;
use App\Models\ChatroomUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ChatroomController extends Controller
{
    public function show(Chatroom $chatroom)
    {
        $this->authorize('view', $chatroom);

        $authIngroup = $chatroom->authors->filter(function ($author) {
            return $author->user->id === auth()->id();
        })->first();

        $otherInGroup = $chatroom->authors->filter(function ($author) {
            return $author->user->id != auth()->id();
        });

        return view('app.message.show', compact('chatroom', 'authIngroup', 'otherInGroup'));
    }

    public function indexArchive()
    {
        $medias = auth()->user()
            ->load('media')
            ->media;

        $chatrooms = auth()->user()
            ->getChatrooms();

        $deletedChatrooms = auth()->user()
            ->getChatrooms(true);

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

        return view('app.message.archive',
            compact(
                'chatrooms',
                'deletedChatrooms',
                'requestCanals',
                'friends',
                'requestFriends',
                'medias'
            ));
    }

    public function view()
    {
        $author = ChatroomUser::find(request('author_id'));

        $author->view_at = Carbon::now();
        $author->save();

        return redirect()->route('homepage');
    }

    public function store()
    {
        $chatroom = Chatroom::create([
            'uuid' => Str::uuid(),
        ]);

        ChatroomUser::create([
            'chatroom_id' => $chatroom->id,
            'user_id' => auth()->id(),
        ]);

        ChatroomUser::create([
            'chatroom_id' => $chatroom->id,
            'user_id' => User::where('uuid', '=', \request('uuid'))->first()->id,
        ]);

        return redirect()->route('chatroom.show', $chatroom->uuid);
    }

    public function create()
    {

    }

    public function messageStore()
    {

    }

    public function rename()
    {
        $chatroom = Chatroom::where('uuid', '=', \request('chatroom_uuid'))
            ->first();

        $chatroom->update([
            'name' => \request('name'),
        ]);

        return redirect()->route('homepage');
    }

    public function accept()
    {
        $user = ChatroomUser::find(request('author_id'));

        $user->acceptCanalRequest();

        return redirect()->route('notification.canals');
    }

    public function deny()
    {
        $user = ChatroomUser::find(request('author_id'));

        $user->denyCanalRequest();

        return redirect()->route('notification.canals');
    }

    public function archive()
    {
        $user = ChatroomUser::withTrashed()
            ->where('id', '=', request('author_id'))
            ->first();

        $user->delete();

        return redirect()->route('homepage');
    }

    public function restore()
    {
        $user = ChatroomUser::withTrashed()
            ->where('id', '=', request('author_id'))
            ->first();

        $user->restore();

        return redirect()->route('chatroom.index.archive');
    }

    public function delete()
    {
        $user = ChatroomUser::withTrashed()
            ->where('id', '=', request('author_id'))
            ->first();

        $user->forceDelete();

        return redirect()->route('homepage');
    }
}
