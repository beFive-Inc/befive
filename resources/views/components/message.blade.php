<div class="item__container">
    @php
        $allWordInMessage = explode(' ', $message->decryptedMessage);
    @endphp

    <div class="message">
        @if($message->relatedMessage)
            @php
                $allWordInRelatedMessage = explode(' ', $message->relatedMessage->decryptedMessage);
            @endphp
            <p class="related_message">
                @foreach($allWordInRelatedMessage as $msg)
                    @if(Str::contains($msg, 'http') && Str::contains($msg, '.gif'))
                        <img src="{{ $msg }}" alt="Gif">
                    @elseif(Str::contains($msg, 'http') || Str::contains($msg, 'www'))
                        <a href="{{ $msg }}" target="_blank">{{ $msg }}</a>
                    @else
                        {{ $msg }}
                    @endif
                @endforeach
            </p>
        @endif
        @if($message->decryptedMessage)
            @php
                if (Str::contains($message->decryptedMessage, 'http') && Str::contains($message->decryptedMessage, '.gif')) {
                    $content = trim(Str::afterLast($message->decryptedMessage, '.gif'));
                }
            @endphp
            <p class="{{ isset($content) && empty($content) ? 'hide' : '' }}">
                @foreach($allWordInMessage as $msg)
                    @if(Str::contains($msg, 'http') && Str::contains($msg, '.gif'))

                    @elseif(Str::contains($msg, 'http') || Str::contains($msg, 'www'))
                        <a href="{{ $msg }}" target="_blank">{{ $msg }}</a>
                    @else
                        {{ $msg }}
                    @endif
                @endforeach
            </p>
        @endif

        @php
            $medias = $message->getMedia('message')
        @endphp
        @if($medias->count())
            <div class="message__img-container">
                @foreach($medias as $media)
                    <div class="message__one-img-container">
                        <img class="message__img" src="{{ $media->getUrl() }}" alt="">
                    </div>
                @endforeach
            </div>
        @endif

        @foreach($allWordInMessage as $msg)
            @if(Str::contains($msg, 'https://www.youtube.com/')
        || Str::contains($msg, 'www.youtube.com/')
        || Str::contains($msg, 'youtube.com/'))
                @php
                    $content = Str::between($msg, 'https://www.youtube.com/watch?v=', ' ');
                @endphp
                <div>
                    <iframe width="100%" src="https://www.youtube.com/embed/{{ $content }}?feature=oembed"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen="">
                    </iframe>
                </div>
            @elseif(Str::contains($msg, 'http') && Str::contains($msg, '.gif'))
                <img src="{{ $msg }}" alt="Gif">
            @endif
        @endforeach
    </div>

    <div class="settings">
        <button type="button" class="dropdown-options special-icon" data-bs-toggle="dropdown" aria-expanded="true">
            <span class="sr_only">{{ __('friends.options') }}</span>
        </button>
        <ul class="dropdown-menu menu" data-popper-placement="bottom-end">
            {{ $settings }}
            @if($message->author->user->id === auth()->id())
                <li>
                    <button class="dropdown-item menu__item menu__danger menu__delete" data-bs-toggle="modal" data-bs-target="#messageDelete-{{ $message->id }}">
                        {{ __('Supprimer le message') }}
                    </button>
                </li>
            @endif
        </ul>

        <div class="modal fade" id="messageDelete-{{ $message->id }}" tabindex="-1" aria-labelledby="messageDelete-{{ $message->id }}">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post"
                              class="form"
                              action="{{ route('chatroom.message.delete', $message->id) }}">
                            @csrf
                            @method('delete')

                            <p class="form__question">
                                {!! __('field.message.delete.question') !!}
                            </p>

                            <p class="form__explain">
                                {!! __('field.message.delete.explain') !!}
                            </p>

                            <input type="hidden" name="message_id" value="{{ $message->id }}">

                            <div class="modal-footer">
                                <span class="btn btn-secondary" data-bs-dismiss="modal">{{ __('app.abort') }}</span>
                                <input type="submit" class="btn btn-danger" value="{{ __('field.message.delete.submit') }}"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
