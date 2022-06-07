<ul class="dropdown-menu menu" aria-labelledby="dropdownMenuClickableInside">
    @foreach($types as $type)
        <li>
            <form method="post" action="{{ route('user.change-status') }}" wire:submit.prevent="changeStatus({{ $type->id }})">
                @csrf
                @method('put')

                <input type="hidden" name="type_id" value="{{ $type->id }}">

                <button type="submit" class="dropdown-item menu__item menu__{{ $type->slug }}
                                        {{ auth()->user()->status->type_id === $type->id ? 'active' : '' }}">
                    {{ __($type->name) }}
                </button>
            </form>
        </li>
    @endforeach
</ul>
