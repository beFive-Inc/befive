<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\Chatroom;
use App\Models\ChatroomUser;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function show(Chatroom $chatroom)
    {
        $this->authorize('view', $chatroom);

        $authIngroup = ChatroomUser::where('group_id', '=', $chatroom->id)
            ->where('user_id', '=', \Auth::id())
            ->first();

        return view('app.message.show', compact('chatroom', 'authIngroup'));
    }

    public function create()
    {
        return redirect()->back();
    }
}
