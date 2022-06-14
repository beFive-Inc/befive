<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">

    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <div class="auth special-auth">
            <div class="auth__form">
                <livewire:profile-edit :medias="$medias" />
            </div>
        </div>
    </x-slot>



    <x-slot name="script">

    </x-slot>
</x-layout>
