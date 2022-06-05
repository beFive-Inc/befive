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
    <div class="friend__selected">
        @foreach($selectedFriends as $key => $friend)
            <x-friend :friend="$friend" :only-image-and-name="true">
                <button data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="{{ __('app.chatroom.remove', [
                            'user' => $friend->pseudo
                        ])}}"
                        wire:click="removeFromChatroom({{ $key }})">
                    <span class="sr_only">
                        {{ __('field.chatroom.create.friend.remove') }}
                    </span>
                </button>
            </x-friend>
        @endforeach
    </div>
    <div class="modal-scrollable">
        <div class="searchbar__query_container">
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
</div>
