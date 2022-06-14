<ul class="dropdown-menu menu {{ $isShow ? 'show' : '' }}" aria-labelledby="dropdownMenuClickableInside">
    <li>
        <form method="post" class="form__status" action="{{ route('user.change-status') }}" wire:submit.prevent="submit">
            @csrf
            @method('put')

            <label class="status-label" for="message">
                {{ __('app.status.label') }}
            </label>

            <div class="status-container">
                <input type="text"
                       id="message"
                       name="message"
                       value="{{ auth()->user()->status->message }}"
                       wire:focus.stop="setIsShowToFalse"
                       wire:focus="setIsShowToTrue"
                       wire:keyup.debounce.1000ms="submit"
                       wire:model.debounce.400ms="message">

                <button type="submit" class="sr_only">
                    <span>{{ __('app.status.submit') }}</span>
                </button>
            </div>
        </form>
    </li>
    @foreach($types as $type)
        <li>
            <form method="post" action="{{ route('user.change-status') }}" wire:submit.prevent="changeStatus({{ $type->id }})">
                @csrf
                @method('put')

                <input type="hidden" name="status_type_id" value="{{ $type->id }}">

                <button type="submit" class="dropdown-item menu__item menu__status-icon menu__{{ $type->slug }}
                                        {{ auth()->user()->status->status_type_id === $type->id ? 'active' : '' }}">
                    {{ __($type->name) }}
                </button>
            </form>
        </li>
    @endforeach
</ul>
