<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias">
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <section class="accordion-item">
            <h2 class="page__title">
                {{ __('app.chatroom.archive') }}
            </h2>
            <div class="searchbar__query_container">
                @if($deletedChatrooms->count())
                    @foreach($deletedChatrooms as $chatroom)
                        <livewire:conversation-message
                            :chatroom="$chatroom"
                            :friends="$friends"
                            :is-archived="true"
                            :all-chatrooms="$chatrooms"/>
                    @endforeach
                @else
                    <p class="no_item">
                        {{ __('app.chatroom.no-archive') }}
                    </p>
                @endif
            </div>
        </section>
    </x-slot>



    <x-slot name="script">

    </x-slot>
</x-layout>
