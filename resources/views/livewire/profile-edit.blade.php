<form action="{{ route('user.update') }}"
      method="post"
      enctype="multipart/form-data"
      class="form special"
      wire:submit.prevent="submit">
    @csrf
    @method('put')

    <div class="profile-edit__img-input-container">
        <div class="profile-edit__img-container">
            @if($photo)
                <img src="{{ $this->getTemporaryRealUrl($photo->temporaryUrl()) }}" alt="{{ __('auth.profile.img') }}">
            @else
                <img src="{{ $medias?->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" alt="{{ __('auth.profile.img') }}">
            @endif
        </div>

        <input type="file"
               name="photo"
               accept="image/*"
               wire:model="photo">
    </div>

    <div class="form__field">
        <label for="pseudo"
               data-bs-toggle="tooltip"
               data-bs-placement="top"
               title="{{ __('auth.pseudo.notice') }}"
               class="form__label">
            {{ __('auth.pseudo.label') }}
        </label>

        <input type="text"
               id="pseudo"
               name="pseudo"
               class="form__input @error('pseudo'){{ 'error' }}@enderror"
               value="{{ old('pseudo') ?? $pseudo }}"
               placeholder="{{ auth()->user()->pseudo }}"
               autocomplete="pseudo"
               wire:model="pseudo"
               required>

        @error('pseudo')
            <span class="error">
                {{ $message }}
            </span>
        @enderror
    </div>

    <div class="form__field">
        <label for="name"
               data-bs-toggle="tooltip"
               data-bs-placement="top"
               title="{{ __('auth.name.notice') }}"
               class="form__label">
            {{ __('auth.name.label') }}
        </label>

        <input type="text"
               id="name"
               name="name"
               class="form__input @error('name'){{ 'error' }}@enderror"
               value="{{ old('name') ?? $name }}"
               placeholder="{{ auth()->user()->name }}"
               wire:model="name">

        @error('name')
            <span class="error">
                {{ $message }}
            </span>
        @enderror
    </div>


    <div class="actions">
        <input type="submit"
               value="{{ __('auth.update') }}"
               class="btn btn-primary">
    </div>
</form>

