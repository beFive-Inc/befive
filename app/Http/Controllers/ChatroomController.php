<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Chatroom;
use Illuminate\Support\Str;
use App\Models\ChatroomUser;
use App\Constant\ChatroomType;
use App\Constant\ChatroomStatus;
use App\Constant\ChatroomUserStatus;
use App\Http\Requests\ChatroomStoreRequest;
use \App\Traits\Chatroom as ChatroomHelper;

class ChatroomController extends Controller
{
    use ChatroomHelper;

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

    public function join()
    {
        $chatroom = Chatroom::with('authors')
            ->where('uuid', '=', request('canal_uuid'))
            ->first();

        $alreadyInCanal = $chatroom->authors->filter(function ($author) {
            return $author->user_id === auth()->id();
        });

        if ($alreadyInCanal->count() === 0) {
            ChatroomUser::create([
                'chatroom_id' => $chatroom->id,
                'user_id' => auth()->id(),
                'status' => ChatroomUserStatus::ACCEPTED,
            ]);
        }

        return redirect()->route('chatroom.show', $chatroom->uuid);
    }

    public function view()
    {
        $author = ChatroomUser::find(request('author_id'));

        $author->view_at = Carbon::now();
        $author->save();

        return redirect()->route('homepage');
    }

    public function store(ChatroomStoreRequest $request)
    {
        $validatedData = $request->validated();
        $chatrooms = auth()->user()
            ->getChatrooms();

        $validatedData['friends'][] = auth()->user()->uuid;

        $friends = User::whereIn('uuid', $validatedData['friends'])
            ->get();

        $isAlreadyAChatroom = collect([]);

        if (!$request->has('type')) {
            $isAlreadyAChatroom = $this->checkIfThisChatroomExist($chatrooms, $friends);
        }

        if ($isAlreadyAChatroom->count()) {
            return redirect()->route('chatroom.show', $isAlreadyAChatroom->first()->uuid);
        } else {
            $chatroom = Chatroom::create([
                'uuid' => Str::uuid(),
                'name' => !empty($validatedData['name']) ? $validatedData['name'] : null,
                'type' => $request->has('type') ? ChatroomType::CANAL : null,
                'status' => $request->has('type') && !$request->has('status') ? ChatroomStatus::PUBLIC : ChatroomStatus::PRIVATE,
            ]);

            foreach ($friends as $friend) {
                ChatroomUser::create([
                    'chatroom_id' => $chatroom->id,
                    'user_id' => $friend->id,
                    'status' => !$request->has('type') && $friend->id != auth()->id() ? ChatroomUserStatus::PENDING : ChatroomUserStatus::ACCEPTED,
                    'view_at' => Carbon::now()
                ]);
            }

        }

        return redirect()->route('chatroom.show', $chatroom->uuid);
    }

    public function create()
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

        return view('app.message.create',
            compact(
                'chatrooms',
                'deletedChatrooms',
                'requestCanals',
                'friends',
                'requestFriends',
                'medias'
            ));
    }

    public function messageStore()
    {

    }

    public function authorRename()
    {
        $author = ChatroomUser::where('id', '=', \request('author_id'))
            ->first();

        $author->update([
            'name' => \request('name'),
        ]);

        return redirect()->route('homepage');
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

    public function messageDelete(Message $message)
    {
        $this->authorize('delete', $message);

        $message->delete();

        return redirect(request()->session()->previousUrl());
    }
}
