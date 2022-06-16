<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">
        {{ __('Be Five Chat | Création d\'une nouvelle salle de discussion') }}
    </x-slot>

    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <section class="auth special-auth">
            <style>
                .checkbox__container::before {
                    content: "{{ __('Canal') }}" !important;
                }
                .checkbox__special-container::before {
                    content: "{{ __(\App\Constant\ChatroomStatus::PRIVATE) }}" !important;
                }
            </style>
            <h2 role="heading" aria-level="2" class="sr_only">
                {{ __('field.chatroom.create.title') }}
            </h2>

            <form action="{{ route('chatroom.store') }}"
                  class="form"
                  method="post">
                @csrf

                <div class="checkbox">
                    <div class="checkbox__container checkbox__special-container show">
                        <input class="checkbox__input"
                               id="status"
                               name="status"
                               type="checkbox"/>
                        <label class="checkbox__label"
                               for="status">
                            <span class="checkbox__span">
                                {{ __(\App\Constant\ChatroomStatus::PUBLIC) }}
                            </span>
                        </label>
                    </div>
                    <div class="checkbox__container">
                        <input class="checkbox__input"
                               id="type"
                               name="type"
                               type="checkbox"/>
                        <label class="checkbox__label"
                               for="type">
                            <span class="checkbox__span">
                                {!! 'Conversation ou Groupe' !!}
                            </span>
                        </label>
                    </div>
                </div>
                <x-field type="text"
                         name="name"
                         id="chatroom-name"
                         :notice="__('auth.name.notice')"
                         :labeltext="__('auth.name.label')"
                         :placeholder="__('auth.name.placeholder')"
                         :autocomplete="false"
                         :required="false">
                </x-field>


                <select name="friends[]" class="form__select" id="friends" size="10" multiple>
                        @foreach($friends as $friend)
                            <option value="{{ $friend->uuid }}">{{ $friend->pseudo }}</option>
                        @endforeach
                </select>

                @if(!$friends->count())
                    <p>{{ __('friends.general.no-friends') }}</p>
                @endif

                <div class="modal-footer">
                    <button type="submit"
                            class="btn btn-primary">
                        {{ __('field.chatroom.create.submit') }}
                    </button>
                </div>
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
