<div class="messages" wire:poll.10000ms="setViewAt">
    <ul class="messages__container">
        @foreach($messages as $msg)
            @php
                $loop->first ? $previousMessage = $msg : $previousMessage = $messages[$loop->index - 1];
            @endphp
            <li class="item {{ $msg->author->user->id === auth()->id() ? 'own' : 'other' }}">
                <x-message :message="$msg"></x-message>
            </li>
            @if($msg->date != $previousMessage->date || $loop->first)
                <li class="item date">
                    {{ $msg->date }}
                </li>
            @endif
        @endforeach
    </ul>

    <form action="{{ route('chatroom.message.store') }}"
          method="post"
          class="form"
          wire:submit.prevent="save">
        @csrf
        <div class="form__container">
            <div wire:loading wire:target="files">Uploading...</div>
            @if($files)
                <div>
                    @foreach($files as $file)
                        <img src="{{ $this->getTemporaryRealUrl($file->temporaryUrl()) }}" width="24" height="24" alt="">
                    @endforeach
                </div>
            @endif

            <input type="hidden" name="member_id" value="{{ $authIngroup->id }}">

            @error('files.*')
                <span class="error">{{ $message }}</span>
            @enderror

            <div class="form__background">
                <input type="text"
                       name="message"
                       rows="1"
                       class="form__input"
                       placeholder="{{ __('app.placeholder') }}"
                       wire:model.debounce.500ms="message"
                       wire:keyup.debounce.300ms="check"/>


                <label for="file" class="form__btn file show">
                    <span class="sr_only">{{ __('field.chatroom.file.label') }}</span>
                </label>
                <input type="file"
                       class="sr_only"
                       id="file"
                       name="files[]"
                       accept="audio/*, video/*, image/*"
                       capture="user"
                       wire:model="files"
                       multiple>

                <button type="submit" class="form__btn send show">
                    <span class="sr_only">{{ __('app.send') }}</span>
                </button>
            </div>
        </div>
    </form>
</div>
