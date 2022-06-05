<article class="chatroom">
    <div class="chatroom__container">
        <div class="chatroom__img_container
            @if(true)
                online
            @else
                offline
            @endif">
            <img src="{{ $chatroom->authors->first()->user?->getFirstMedia('profile')?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="chatroom__img" alt>
        </div>
        <div class="chatroom__info">
            <h3 aria-level="3"
                role="heading"
                class="chatroom__name {{ empty($chatroom->messages->first()->view_at) ? 'new' : ''  }}"
                data-bs-toggle="tooltip"
                data-bs-placement="right"
                data-bs-html="true"
                title='<x-data-title :chatroom="$chatroom"/>'>
                <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__link">
                    @if($chatroom->name)
                        {{ $chatroom->name }}
                    @else
                        {{ $chatroom->authors->first()->user->pseudo }}
                    @endif
                </a>
            </h3>
            <div class="chatroom__message_container">
                <p class="chatroom__message {{ empty($chatroom->messages->first()->view_at) ? 'new' : ''  }}">
                    {{ $chatroom->messages->first()?->message }}
                </p>
                <p class="chatroom__date">
                    {{ $chatroom->messages->first()?->date }}
                </p>
            </div>
        </div>
    </div>
    <div>
        <button type="button" class="dropdown-options" data-bs-toggle="dropdown" aria-expanded="true">
            <span class="sr_only">{{ __('friends.options') }}</span>
        </button>
        <ul class="dropdown-menu menu" data-popper-placement="bottom-end">
            <li>
                <button class="dropdown-item menu__item menu__rename" data-bs-toggle="modal" data-bs-target="#chatroomRename-{{ $chatroom->uuid }}">
                    {{ __('app.conversations.rename') }}
                </button>
            </li>
            <li>
                <form method="post"
                      action="{{ route('chatroom.archive') }}">
                    @csrf
                    @method('delete')
                    <input type="hidden" name="uuid" value="{{ $chatroom->uuid }}">

                    <button type="submit" class="dropdown-item menu__item menu__message-archive">{{ __('app.conversations.archive') }}</button>
                </form>
            </li>
            <li>
                <button class="dropdown-item menu__item menu__rename" data-bs-toggle="modal" data-bs-target="#chatroomCreateWith-{{ $chatroom->uuid }}">
                    {{ __('app.conversations.create', [
                        'user' => $chatroom->authors->first()->user->pseudo,
                    ]) }}
                </button>
            </li>
            <li>
                <button class="dropdown-item menu__item menu__danger menu__block" data-bs-toggle="modal" data-bs-target="#friendBlock-{{ $chatroom->authors->first()->user->uuid }}">
                    {{ __('friends.block') }}
                </button>
            </li>
            <li>
                <button class="dropdown-item menu__item menu__danger menu__delete" data-bs-toggle="modal" data-bs-target="#chatroomDelete-{{ $chatroom->uuid }}">
                    {{ __('app.conversations.delete') }}
                </button>
            </li>
        </ul>

        <div class="modal fade" id="chatroomRename-{{ $chatroom->uuid }}" tabindex="-1" aria-labelledby="chatroomRename-{{ $chatroom->uuid }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('chatroom.rename') }}"
                              method="post"
                              class="form">
                            @csrf
                            @method('put')

                            <input type="hidden" name="chatroom_uuid" value="{{ $chatroom->uuid }}">

                            <x-field type="text"
                                     name="name"
                                     :id="'name-' . $chatroom->id"
                                     :notice="__('field.conversation.rename.notice')"
                                     :labeltext="__('field.conversation.rename.label')"
                                     :placeholder="!empty($chatroom->name) ? $chatroom->name : __('app.placeholder')"
                                     :autocomplete="'name'"
                                     :required="true">
                            </x-field>

                            <div class="modal-footer">
                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                <input type="submit" class="btn btn-primary" value="{{ __('field.conversation.rename.submit') }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="friendBlock-{{ $chatroom->authors->first()->user->uuid }}" tabindex="-1" aria-labelledby="friendBlock-{{ $chatroom->authors->first()->user->uuid }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post"
                              class="form"
                              action="{{ route('friends.block') }}">
                            @csrf
                            @method('put')

                            <p class="form__question">
                                {!! __('field.conversation.friend.block.question') !!}
                            </p>

                            <p class="form__explain">
                                {!!  __('field.conversation.friend.block.explain') !!}
                            </p>

                            <input type="hidden" name="uuid" value="{{ $chatroom->authors->first()->user->uuid }}">

                            <div class="modal-footer">
                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                <input type="submit" class="btn btn-primary" value="{{ __('field.conversation.friend.block.submit') }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="chatroomCreateWith-{{ $chatroom->uuid }}" tabindex="-1" aria-labelledby="chatroomCreateWith-{{ $chatroom->uuid }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-special-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <livewire:chatroom-create :friend-list="$friends" :pre-selected-friends="$chatroom->authors"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="chatroomDelete-{{ $chatroom->uuid }}" tabindex="-1" aria-labelledby="chatroomDelete-{{ $chatroom->uuid }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post"
                              class="form"
                              action="{{ route('chatroom.delete') }}">
                            @csrf
                            @method('delete')

                            <p class="form__question">
                                {!! __('field.conversation.delete.question') !!}
                            </p>

                            <p class="form__explain">
                                {!! __('field.conversation.delete.explain') !!}
                            </p>

                            <input type="hidden" name="uuid" value="{{ $chatroom->uuid }}">

                            <div class="modal-footer">
                                <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                <input type="submit" class="btn btn-danger" value="{{ __('field.conversation.delete.submit') }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
