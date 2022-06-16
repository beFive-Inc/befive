<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">

    </x-slot>

    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <section class="auth special-auth">
            <h2 aria-level="2" role="heading" class="sr_only">
                {{ __('app.status.update') }}
            </h2>
            <form action="{{ route('user.change-status') }}" method="post" class="form special-form">
                @csrf
                @method('put')

                <x-field type="text"
                         name="status-name"
                         id="status-name"
                         :notice="__('field.status.update.notice')"
                         :labeltext="__('field.status.update.label')"
                         :placeholder="!empty(auth()->user()->status->message) ? auth()->user()->status->message :  __('field.status.update.placeholder')"
                         :value="!empty(auth()->user()->status->message) ? auth()->user()->status->message : ''"
                         :autocomplete="false"
                         :required="true">
                </x-field>

                <select name="type" id="type">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ $type->id === auth()->user()->type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>

                <button class="btn btn-primary">
                    {{ __('field.status.update.submit') }}
                </button>
            </form>
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
