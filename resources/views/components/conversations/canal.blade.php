<article class="chatroom">
    <div class="chatroom__info">
        <h4 aria-level="4" role="heading" class="chatroom__name">
            <a href="{{ route('chatroom.show', $chatroom->uuid) }}" class="chatroom__link">
                # {{ $chatroom->name }}
            </a>
        </h4>

        <p class="chatroom__members">
            {{ $chatroom->authors->count() }} {{ $chatroom->authors->count() == 1 ? __('user.member') : __('user.members') }}
        </p>
    </div>

    <div class="actions">
        {{ $slot }}
    </div>

    @if($settings)
        <div>
            <button type="button" class="dropdown-options" data-bs-toggle="dropdown" aria-expanded="true">
                <span class="sr_only">{{ __('friends.options') }}</span>
            </button>
            <ul class="dropdown-menu menu" data-popper-placement="bottom-end">
                <li>
                    <button class="dropdown-item menu__item menu__danger menu__delete" data-bs-toggle="modal" data-bs-target="#chatroomLeave-{{ $chatroom->uuid }}">
                        {{ __('app.groups.leave') }}
                    </button>
                </li>
            </ul>

            <div class="modal fade" id="chatroomLeave-{{ $chatroom->uuid }}" tabindex="-1" aria-labelledby="chatroomLeave-{{ $chatroom->uuid }}">
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
                                    {!! __('field.group.leave.question') !!}
                                </p>

                                <p class="form__explain">
                                    {!! __('field.group.leave.explain') !!}
                                </p>

                                <input type="hidden" name="author_id" value="{{ $chatroom->authors->filter(function ($author) {
                                    return $author->user_id === auth()->id(); })?->first()?->id }}">

                                <div class="modal-footer">
                                    <span type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                    <input type="submit" class="btn btn-primary" value="{{ __('field.group.leave.submit') }}"/>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</article>
