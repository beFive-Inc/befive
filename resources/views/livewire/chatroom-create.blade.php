<div>
    <div class="searchbar">
        <div class="form">
            <div class="form__btn">
                <img src="{{ asset('parts/icons/outline/search-normal-1.svg') }}"
                     alt>
            </div>
            <div class="form__search_container">
                <input class="form__search"
                       name="query"
                       wire:model.debounce.200ms="query"
                       placeholder="{{ __('field.chatroom.create.search.placeholder') }}"/>
            </div>
        </div>
    </div>
    @if($selectedFriends->count() || $preSelectedFriends->count())
        <div class="friend__selected">
            @foreach($preSelectedFriends as $friend)
                <x-friend :friend="$friend" :only-image-and-name="true">
                    @if(!$preSelectedFriendsAreRequired)
                    <button data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            class="friend__remove"
                            title="{{ __('app.chatroom.remove', [
                                'user' => $friend->pseudo
                            ])}}"
                            wire:click="removeFromChatroom({{ $friend->key }})">
                        <span class="sr_only">
                            {{ __('field.chatroom.create.friend.remove') }}
                        </span>
                        <span class="icon"></span>
                    </button>
                    @endif
                </x-friend>
            @endforeach
            @foreach($selectedFriends as $friend)
                <x-friend :friend="$friend" :only-image-and-name="true">
                    <button data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            class="friend__remove"
                            title="{{ __('app.chatroom.remove', [
                                'user' => $friend->pseudo
                            ])}}"
                            wire:click="removeFromChatroom({{ $friend->key }})">
                        <span class="sr_only">
                            {{ __('field.chatroom.create.friend.remove') }}
                        </span>
                        <span class="icon"></span>
                    </button>
                </x-friend>
            @endforeach
        </div>
    @endif
    <div class="modal-scrollable">
        <div class="searchbar__query_container">
            @if($friends->count() || $preSelectedFriends->count())
                @foreach($friends as $key => $friend)
                    <x-friend :friend="$friend">
                        <div class="actions">
                            <button wire:click="toggleToChatroom({{ $key }})"
                                    class="add_to_chatroom {{ $this->isInTheChatroom($key) ? 'selected' : '' }}"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="left"
                                    title="{{ $this->isInTheChatroom($key) ? __('app.chatroom.add.already', ['user' => $friend->pseudo]) : __('app.chatroom.add', ['user' => $friend->pseudo]) }}">
                                <span class="sr_only">{{ $this->isInTheChatroom($key) ? __('app.chatroom.add.already', ['user' => $friend->pseudo]) : __('app.chatroom.add', ['user' => $friend->pseudo]) }}</span>
                            </button>
                        </div>
                    </x-friend>
                @endforeach
                    @foreach($preSelectedFriends as $key => $friend)
                        <x-friend :friend="$friend">
                            <div class="actions">
                                <button
                                    @if(!$preSelectedFriendsAreRequired)
                                        wire:click="toggleToChatroom({{ $key }})"
                                    @endif
                                    class="add_to_chatroom {{ $this->isInTheChatroom($key) ? 'selected' : '' }}"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="left"
                                    {{ !$preSelectedFriendsAreRequired ? '' : 'disabled' }}
                                    title="{{ $this->isInTheChatroom($key) ? __('app.chatroom.add.already', ['user' => $friend->pseudo]) : __('app.chatroom.add', ['user' => $friend->pseudo]) }}">
                                    <span class="sr_only">{{ $this->isInTheChatroom($key) ? __('app.chatroom.add.already', ['user' => $friend->pseudo]) : __('app.chatroom.add', ['user' => $friend->pseudo]) }}</span>
                                </button>
                            </div>
                        </x-friend>
                    @endforeach
            @else
                <p>
                    {{ __('app.chatroom.add.search.nothing', ["search" => $query]) }}
                </p>
            @endif
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit"
               class="btn btn-primary"
               wire:click="createChatroom"
                @if(!$selectedFriends->count()) disabled @endif>
            {{ __('field.chatroom.create.submit') }}
        </button>
    </div>
    @if($error)
        <div>
            <p class="error">
                {{ $error }}
            </p>
        </div>
    @endif
</div>
