<div>
    <section class="user_card">
        @if($bannerpic)
            <div>
                <img src="{{ $temporaryBannerImg }}"
                     alt>
            </div>
        @endif

        @if($profilpic)
            <div>
                <img src="{{ $temporaryProfilImg }}"
                     alt>
            </div>
        @endif

        <h2 aria-level="2" role="heading" class="user_card__title">
            {{ auth()->user()->pseudo }} <span class="user_card__hashtag">{{ '#' . auth()->user()->hashtag }}</span>
        </h2>

        <p class="user_card__name">
            {{ auth()->user()->name ?? $name }}
        </p>
    </section>

    <form action="{{ route('step.first.store') }}"
          method="post"
          wire:submit.prevent="save">
        @csrf

        @if(!isset(auth()->user()->name))
            <div>
                <label for="name">
                    Nom & prénom <span>({{ __('Optionnel') }})</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       class=""
                       wire:model="name">

                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
        @endif

        <div>
            <label for="profile_pic">
                Photo de profil <span>({{ __('Optionnel') }})</span>
            </label>

            <input type="file"
                   name="profile_pic"
                   id="profile_pic"
                   class=""
                   wire:model="profilpic">

            @error('profilpic')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div>
            <label for="banner_pic">
                Photo de banière <span>({{ __('Optionnel') }})</span>
            </label>

            <input type="file"
                   name="banner_pic"
                   id="banner_pic"
                   class=""
                   wire:model="bannerpic">

            @error('bannerpic')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <input type="submit"
               value="Sauvegarder et passer à l'étape 2">
    </form>

</div>
