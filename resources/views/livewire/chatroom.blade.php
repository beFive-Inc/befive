<div class="messages">
    <ul class="messages__container">
        @foreach($messages as $msg)
            @php
                $loop->last ? $nextMessage = $msg : $nextMessage = $messages[$loop->iteration];
            @endphp
            <li class="item {{ $msg->author->user->id === auth()->id() ? 'own' : 'other' }}">
                <x-message :message="$msg" :is-settings="true">
                    <x-slot name="settings">
                        <li>
                            <button class="dropdown-item menu__item menu__rename" wire:click="setRelatedMessage({{ $msg->id }})">
                                {{ __('Répondre') }}
                            </button>
                        </li>
                    </x-slot>
                </x-message>
            </li>

            @if($msg->author->user->pseudo != $nextMessage->author->user->pseudo || $loop->last)
                <li class="item messages__name {{ $msg->author->user->id === auth()->id() ? 'own' : 'other' }}
                {{ $msg->author->user->pseudo != $nextMessage->author->user->pseudo && $msg->author->user->pseudo != auth()->user()->pseudo  ? 'other-other' : '' }}">
                    <div class="messages__name-container">
                        <div class="messages__name-img-container">
                            <img src="{{ $msg->author->user->getMedia('profile')?->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" alt="Photo de profil de {{ $msg->author->user->pseudo }}">
                        </div>
                        <p>
                            {{ empty($msg->author->name) ? $msg->author->user->pseudo : $msg->author->name }}
                        </p>
                    </div>
                </li>
            @endif
            @if($msg->date != $nextMessage->date || $loop->last)
                <li class="item date">
                    {{ $msg->date }}
                </li>
            @endif
        @endforeach
    </ul>

    <form action="{{ route('chatroom.message.store') }}"
          method="post"
          class="form special-form"
          wire:submit.prevent="save">
        @csrf
        <div class="special-form__container">
            <div wire:loading wire:target="files" wire:loading.flex wire:loading.class="uploading">
                @for($i = 0; $i < 3; $i++)
                    <div class="uploading__container">
                        <div class="uploading__content">

                        </div>
                    </div>
                @endfor
            </div>
            @if($files)
                <div class="uploading">
                    @foreach($files as $key => $file)
                        <div class="uploading__container">
                            <img src="{{ $this->getTemporaryRealUrl($file->temporaryUrl()) }}" alt="Preview des images uploadées">
                            <button wire:click.prevent="deleteFileFromArray({{ $key }})" class="uploading__remove-btn">
                                <span class="sr_only">{{ __('app.message.file.delete') }}</span>
                            </button>
                        </div>
                    @endforeach
                </div>
            @endif

            <input type="hidden" name="member_id" value="{{ $authIngroup->id }}">

            @error('files.*')
                <span class="error">{{ $message }}</span>
            @enderror

            @if($error)
                <span class="error">{{ $error }}</span>
            @endif

            @if($relatedMessage->count())
                <div class="related-container">
                    <p class="related-title">
                        {{ __('field.related.title') }}
                    </p>
                    <p class="related-text">
                        {{ $relatedMessage->decryptedMessage }}
                    </p>
                    <button type="button" class="related-btn" wire:click="unsetRelatedMessage">
                        <span class="sr_only">{{ __('field.related.submit') }}</span>
                    </button>
                </div>
            @endif

            <div class="special-form__background">
                <input type="text"
                       name="message"
                       rows="1"
                       class="special-form__input"
                       placeholder="{{ __('app.placeholder') }}"
                       wire:model.debounce.500ms="message"
                       wire:keyup.debounce.300ms="check"/>


                <label for="file" class="special-form__btn file show">
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

                <button type="submit" class="special-form__btn send show">
                    <span class="sr_only">{{ __('app.send') }}</span>
                </button>
            </div>
        </div>
    </form>
</div>
