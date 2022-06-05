<?php

namespace App\Http\Controllers;

use App\Events\FriendAdded;
use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MessageController extends Controller
{
    public function show(Chatroom $chatroom)
    {
        $this->authorize('view', $chatroom);

        $authIngroup = $chatroom->authors->filter(function ($author){
            return $author->user->id === \Auth::id();
        })->first();

        return view('app.message.show', compact('chatroom', 'authIngroup'));
    }

    public function indexArchive()
    {
        return view('app.home.index');
    }

    public function create()
    {
        return redirect()->back();
    }

    public function createConversation()
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

    public function rename()
    {
        $chatroom = Chatroom::where('uuid', '=', \request('chatroom_uuid'))
            ->first();

        $chatroom->update([
            'name' => \request('name'),
        ]);

        return redirect()->route('homepage');
    }

    public function archive()
    {
        $user = ChatroomUser::whereHas('chatroom', function ($query) {
            return $query->where('uuid', '=', \request('uuid'));
        })->where('user_id', '=', Auth::id())
        ->first();

        $user->delete();

        return redirect()->route('homepage');
    }

    public function delete()
    {
        $user = ChatroomUser::whereHas('chatroom', function ($query) {
            return $query->where('uuid', '=', \request('uuid'));
        })->where('user_id', '=', Auth::id())
            ->first();

        $user->forceDelete();

        return redirect()->route('homepage');
    }
}
