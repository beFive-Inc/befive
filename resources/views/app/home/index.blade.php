<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>

    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <livewire:homepage :chatrooms="$chatrooms" :friends="$friends"/>
    </x-slot>

    <x-slot name="script">
        <script>
            Echo.channel("user.{{ auth()->id() }}")
                .listen('FriendAdded', (e) => {
                    window.livewire.emit('friendAdded');
                });

            Echo.channel('chatroom.{{ auth()->user()->uuid }}')
                .listen('ChatroomCreated', (e) => {
                    window.livewire.emit('refreshChatrooms');
                });
        </script>
    </x-slot>
</x-layout>
