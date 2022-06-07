<x-message-layout :chatroom="$chatroom" :other-in-group="$otherInGroup">
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
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
                .listen('MessageSent', (e) => {
                    window.livewire.emit('messageSent', e.message)
                }).listenForWhisper('typing', (e) => {
                    console.log(e);
                });
        </script>
    </x-slot>
</x-message-layout>
