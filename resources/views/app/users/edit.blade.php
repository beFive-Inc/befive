<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms">
    <x-slot name="title">

    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <div class="auth">
            <div class="auth__form">
                <form action="{{ route('user.update') }}"
                      method="post"
                      class="form special">
                    @csrf
                    @method('put')

                    <livewire:image-update :medias="$medias" />

                    <x-field type="text"
                             name="pseudo"
                             id="pseudo"
                             :notice="__('auth.pseudo.notice')"
                             :labeltext="__('auth.pseudo.label')"
                             :placeholder="auth()->user()->pseudo"
                             :value="auth()->user()->pseudo"
                             :autocomplete="'name'"
                             :required="true">
                    </x-field>

                    <x-field type="text"
                             name="name"
                             id="name"
                             :notice="__('auth.name.notice')"
                             :labeltext="__('auth.name.label')"
                             :placeholder="auth()->user()->name"
                             :value="auth()->user()->name"
                             :autocomplete="'name'"
                             :required="true">
                    </x-field>

                    <div class="actions">
                        <input type="submit"
                               value="{{ __('auth.update') }}"
                               class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </x-slot>



    <x-slot name="script">

    </x-slot>
</x-layout>
