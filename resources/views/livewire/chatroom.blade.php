<div class="messages" wire:poll.10000ms="setViewAt">
    <ul class="messages__container">
        @foreach($messages as $msg)
            <li class="item {{ $msg->author->user->id === auth()->id() ? 'own' : 'other' }}">
                <x-message :message="$msg"></x-message>
            </li>
        @endforeach
    </ul>

    <form action="{{ route('chatroom.create') }}"
          method="post"
          class="form"
          wire:submit.prevent="send">
        @csrf

        <div class="form__container">
            <input type="hidden" name="member_id" value="{{ $authIngroup->id }}">
            <input type="text"
                   name="message"
                   rows="1"
                   class="form__input"
                   placeholder="{{ __('app.placeholder') }}"
                   wire:model.debounce.500ms="message"
                   wire:keyup.debounce.300ms="check"/>

            <button type="submit" class="form__btn send form__hide {{ !empty($message) ? 'show' : '' }}">
                <span class="sr_only">{{ __('app.send') }}</span>
            </button>
        </div>
    </form>
</div>
