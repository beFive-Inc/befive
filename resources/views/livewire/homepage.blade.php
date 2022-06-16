<div class="accordion">
    <section class="discussion">
        <h2 aria-level="2"
            role="heading"
            class="sr_only">
            {{ __('app.chatroom.title') }}
        </h2>
        <section class="accordion-item">
            <h3 aria-level="3"
                role="heading"
                class="accordion-header"
                id="panelsStayOpen-headingOne">
                <button class="accordion-button"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapseOne"
                        aria-expanded="true"
                        aria-controls="panelsStayOpen-collapseOne">
                    {{ __('app.canals') }}
                </button>
            </h3>
            <div id="panelsStayOpen-collapseOne"
                 class="accordion-collapse collapse show"
                 aria-labelledby="panelsStayOpen-headingOne">
                <div class="accordion-body accordion-canal">
                    @if($canals->count())
                        @foreach($canals as $chatroom)
                            <div class="chatroom__select {{ $selectedChatroom->uuid === $chatroom->uuid ? 'selected' : '' }}">
                                <x-canal :chatroom="$chatroom"/>
                                <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__select-link" wire:click.prevent="changeSelectedChatroom('{{ $chatroom->uuid }}')" >
                                    <span class="sr_only">{{ __('Voir la chatroom') }}</span>
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div>
                            <p class="text_explain">
                                {{ __('app.chatroom.discover.text') }}, <a href="{{ route('discover') }}" class="link">
                                    {{ __('app.chatroom.discover') }}
                                </a>
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        @if($groups->count())
            <section class="accordion-item">
                <h3 aria-level="3"
                    role="heading"
                    class="accordion-header"
                    id="panelsStayOpen-headingTwo">
                    <button class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseTwo"
                            aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseTwo">
                        {{ __('app.groups') }}
                    </button>
                </h3>
                <div id="panelsStayOpen-collapseTwo"
                     class="accordion-collapse collapse show"
                     aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        @foreach($groups as $chatroom)
                            <div class="chatroom__select {{ $selectedChatroom->uuid === $chatroom->uuid ? 'selected' : '' }}">
                                <x-group-message :chatroom="$chatroom"/>
                                <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__select-link" wire:click.prevent="changeSelectedChatroom('{{ $chatroom->uuid }}')" >
                                    <span class="sr_only">{{ __('Voir la chatroom') }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        @if($conversations->count())
            <section class="accordion-item">
                <h3 aria-level="3"
                    role="heading"
                    class="accordion-header"
                    id="panelsStayOpen-headingThree">
                    <button class="accordion-button"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapseThree"
                            aria-expanded="false"
                            aria-controls="panelsStayOpen-collapseThree">
                        {{ __('app.conversations') }}
                    </button>
                </h3>
                <div id="panelsStayOpen-collapseThree"
                     class="accordion-collapse collapse show"
                     aria-labelledby="panelsStayOpen-headingThree">
                    <div class="accordion-body">
                        @foreach($conversations as $chatroom)
                            <div class="chatroom__select {{ $selectedChatroom->uuid === $chatroom->uuid ? 'selected' : '' }}">
                                <x-conversation-message :chatroom="$chatroom"
                                                        :own-author="$chatroom->authors->filter(
                                                    function ($author) {return $author->user->id === auth()->id();})
                                                    ->first()"
                                                        :other-author="$chatroom->authors->filter(
                                                    function ($author) {return $author->user->id != auth()->id();})
                                                    ->first()"/>
                                <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__select-link" wire:click.prevent="changeSelectedChatroom('{{ $chatroom->uuid }}')" >
                                    <span class="sr_only">{{ __('Voir la chatroom') }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </section>
    @if($chatrooms->count())
        <livewire:chatroom :chatroom="$selectedChatroom" />
    @endif

    <script>
        @foreach($chatrooms as $chatroom)
            Echo.join(`chatroom.{{ $chatroom->uuid }}`)
                .here(users => {

                })
                .joining(user => {

                })
                .leaving(user => {

                })
                .listen('MessageSent', (e) => {
                    window.livewire.emit('messageSent-{{ $chatroom->uuid }}')
                });
        @endforeach
    </script>
</div>

