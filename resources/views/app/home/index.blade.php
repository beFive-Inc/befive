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
        </script>

        <script>
            @foreach($chatrooms as $chatroom)
                Echo.join(`chatroom.<?= $chatroom->uuid ?>`)
                    .here(users => {
                        console.log(users.length + ' utilisateurs')
                    })
                    .joining(user => {
                        console.log(user.name + ' a rejoint')
                    })
                    .leaving(user => {
                        console.log(user.name + ' est parti')
                    })
                    .listen('MessageSent', (e) => {
                        window.livewire.emit('messageSent')
                    });
            @endforeach
        </script>
    </x-slot>
</x-layout>
