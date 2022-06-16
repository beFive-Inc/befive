<x-message-layout :chatroom="$chatroom" :other-in-group="$otherInGroup">
    <x-slot name="title">
        {{ __('Be Five Chat | Salle de discussion') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>


    <x-slot name="content">
        <livewire:chatroom
            :chatroom="$chatroom"
            :auth-ingroup="$authIngroup" />
    </x-slot>


    <x-slot name="script">
        <script>
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
                .listenForWhisper('typing', (e) => {
                    console.log(e.name);
                })
                .listen('MessageSent', (e) => {
                    window.livewire.emit('messageSent', e.message)
                });
        </script>
    </x-slot>
</x-message-layout>
