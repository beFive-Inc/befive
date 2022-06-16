<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">
        {{ __('Be Five Chat | Découverte') }}
    </x-slot>

    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <section class="discover">
            <h2 aria-level="2" role="heading" class="sr_only">
                {{ __('app.chatroom.title') }}
            </h2>
            <section>
                <h3 aria-level="3" role="heading" class="sr_only">
                    {{ __('app.canals') }}
                </h3>

                <div class="special-container">
                    @foreach($canals as $canal)
                        <x-canal :chatroom="$canal">
                            <form action="{{ route('chatroom.join') }}" method="post">
                                @csrf

                                <input type="hidden" name="canal_uuid" value="{{ $canal->uuid }}">
                                <button class="btn btn-secondary">
                                    {{ __('app.join') }}
                                </button>
                            </form>
                        </x-canal>
                    @endforeach

                    {{ $canals->links() }}
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
