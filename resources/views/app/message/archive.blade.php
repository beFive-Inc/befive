<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <section class="accordion-item">
            <h2 aria-level="2" role="heading" class="sr_only">
                {{ __('app.chatroom.archive') }}
            </h2>
            <section>
                <h3 aria-level="3" role="heading" class="page__title">
                    {{ __('app.chatroom.archive.conversation') }}
                </h3>

                <div class="searchbar__query_container">
                    @if($deletedChatrooms->count())
                        @foreach($deletedChatrooms as $chatroom)
                            <x-conversation-message :chatroom="$chatroom"
                                                    :is-archived="true"
                                                    :own-author="$chatroom->authors->filter(
                                                    function ($author) {return $author->user->id === auth()->id();})
                                                    ->first()"
                                                    :other-author="$chatroom->authors->filter(
                                                    function ($author) {return $author->user->id != auth()->id();})
                                                    ->first()"/>
                        @endforeach
                    @else
                        <p class="no_item">
                            {{ __('app.chatroom.no-archive') }}
                        </p>
                    @endif
                </div>
            </section>
        </section>
    </x-slot>



    <x-slot name="script">
        <script>
            Echo.channel("user.{{ auth()->id() }}")
                .listen('FriendAdded', (e) => {
                    window.livewire.emit('friendAdded');
                });
        </script>
    </x-slot>
</x-layout>
