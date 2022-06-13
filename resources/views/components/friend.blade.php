<article class="friend">
    <div class="friend__container {{ $onlyImageAndName ? 'special' : '' }}">
        <div class="friend__img_container status
        {{ $friend->sessions->last()->last_activity >= \Carbon\Carbon::now() && $friend->type->name ? Str::slug($friend->type->name) : 'offline' }}">
            <img src="{{ $friend->media?->first()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" class="friend__img" alt>
        </div>

        <div class="friend__info">
            <h4 aria-level="4" role="heading" class="friend__pseudo">
                {{ $friend->pseudo }}
            </h4>
            @if(!$onlyImageAndName)
                <p class="friend__hashtag">
                    {{ $getStatusMessage ? __($friend->statusMessage) : '#' . $friend->hashtag }}
                </p>
            @endif
        </div>
    </div>
    @if($actions)
        <div class="actions">
            {{ $slot }}
        </div>
   @endif

    @if($options)
        <div>
            <button type="button" class="dropdown-options" data-bs-toggle="dropdown" aria-expanded="true">
                <span class="sr_only">{{ __('friends.options') }}</span>
            </button>
            <ul class="dropdown-menu menu" data-popper-placement="bottom-end">
                @if($isFriend)
                    <li>
                        <button class="dropdown-item menu__item menu__danger menu__block" data-bs-toggle="modal" data-bs-target="#friendBlock-{{ $friend->uuid }}">
                            {{ __('friends.block') }}
                        </button>
                    </li>
                    <li>
                        <button class="dropdown-item menu__item menu__danger menu__friend-delete" data-bs-toggle="modal" data-bs-target="#friendDelete-{{ $friend->uuid }}">
                            {{ __('friends.delete') }}
                        </button>
                    </li>
                @endif
                @if($isAsked)
                    <li>
                        <button class="dropdown-item menu__item menu__danger menu__block" data-bs-toggle="modal" data-bs-target="#deleteSentRequest-{{ $friend->uuid }}">
                            {{ __('friends.request.delete') }}
                        </button>
                    </li>
                @endif
                @if($isBlocked)
                    <li>
                        <button class="dropdown-item menu__item menu__danger menu__block" data-bs-toggle="modal" data-bs-target="#friendUnblock-{{ $friend->uuid }}">
                            {{ __('friends.unblock') }}
                        </button>
                    </li>
                @endif
            </ul>


            @if($isFriend)
                <div class="modal fade" id="friendBlock-{{ $friend->uuid }}" tabindex="-1" aria-labelledby="friendBlock-{{ $friend->uuid }}">
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

                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                    <div class="modal-footer">
                                        <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                        <input type="submit" class="btn btn-primary" value="{{ __('field.conversation.friend.block.submit') }}"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="friendDelete-{{ $friend->uuid }}" tabindex="-1" aria-labelledby="friendDelete-{{ $friend->uuid }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post"
                                      class="form"
                                      action="{{ route('friends.delete') }}">
                                    @csrf
                                    @method('delete')

                                    <p class="form__question">
                                        {!! __('field.conversation.friend.delete.question') !!}
                                    </p>

                                    <p class="form__explain">
                                        {!! __('field.conversation.friend.delete.explain') !!}
                                    </p>

                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                    <div class="modal-footer">
                                        <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                        <input type="submit" class="btn btn-danger" value="{{ __('field.conversation.friend.delete.submit') }}"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($isAsked)
                <div class="modal fade" id="deleteSentRequest-{{ $friend->uuid }}" tabindex="-1" aria-labelledby="deleteSentRequest-{{ $friend->uuid }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post"
                                      class="form"
                                      action="{{ route('friends.delete') }}">
                                    @csrf
                                    @method('delete')

                                    <p class="form__question">
                                        {!! __('field.conversation.friend.request.delete.question') !!}
                                    </p>

                                    <p class="form__explain">
                                        {!! __('field.conversation.friend.request.delete.explain') !!}
                                    </p>

                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                    <div class="modal-footer">
                                        <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                        <input type="submit" class="btn btn-primary" value="{{ __('field.conversation.friend.request.delete.submit') }}"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($isBlocked)
                <div class="modal fade" id="friendUnblock-{{ $friend->uuid }}" tabindex="-1" aria-labelledby="friendUnblock-{{ $friend->uuid }}">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post"
                                      class="form"
                                      action="{{ route('friends.unblock') }}">
                                    @csrf
                                    @method('put')

                                    <p class="form__question">
                                        {!! __('field.conversation.friend.unblock.question') !!}
                                    </p>

                                    <p class="form__explain">
                                        {!! __('field.conversation.friend.unblock.explain') !!}
                                    </p>

                                    <input type="hidden" name="uuid" value="{{ $friend->uuid }}">

                                    <div class="modal-footer">
                                        <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                        <input type="submit" class="btn btn-primary" value="{{ __('field.conversation.friend.unblock.submit') }}"/>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endif
</article>
