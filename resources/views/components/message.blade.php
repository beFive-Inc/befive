<div class="item__container">
    @php
        $allWordInMessage = explode(' ', $message->decryptedMessage);
    @endphp

    <div class="message">
        <p>
            @foreach($allWordInMessage as $msg)
                @if(Str::contains($msg, 'http') || Str::contains($msg, 'www'))
                    <a href="{{ $msg }}">{{ $msg }}</a>
                @else
                    {{ $msg }}
                @endif
            @endforeach
        </p>

        @if($medias = $message->getMedia('message'))
            @foreach($medias as $media)
                <img class="message__img" src="{{ $media->getUrl() }}" alt="">
            @endforeach
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
            @endif
        @endforeach
    </div>
</div>
