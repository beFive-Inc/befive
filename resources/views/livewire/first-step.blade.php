<div class="steps">
    <article class="steps__preview_card preview_card">
        <div class="preview_card__logo">
            <img src="{{ asset('storage/images/logo/befive_logo_white_background.svg') }}" alt="Logo de Befive">
        </div>
        <h2 aria-level="2" role="heading" class="preview_card__title">
            {{ __('Prévisualisation de votre carte') }}
        </h2>

        <section class="user_card">
            @if($bannerpic)
                <div class="user_card__bannerpic">
                    <img src="{{ $temporaryBannerImg }}"
                         alt>
                </div>
            @endif

            @if($profilpic)
                <div class="user_card__profilpic">
                    <img src="{{ $temporaryProfilImg }}"
                         alt>
                </div>
            @endif

            <div class="user_card__info">
                <h3 aria-level="2" role="heading" class="user_card__title">
                    {{ auth()->user()->pseudo }} <span class="user_card__hashtag">{{ '#' . auth()->user()->hashtag }}</span>
                </h3>

                <p class="user_card__name">
                    {{ auth()->user()->name ?? $name }}
                </p>
            </div>
        </section>
    </article>


    <div class="steps__form_container">
        <x-step-nav></x-step-nav>

        <form action="{{ route('step.first.store') }}"
              method="post"
              enctype="multipart/form-data"
              class="steps__step_form step_form"
              wire:submit.prevent="save">
            @csrf


            <p class="step_form__progression">
                {{ __('Étape') . ' 1/3' }}
            </p>

            <p class="step_form__title">
                {{ __('Personnalisation') }}
            </p>

            <div class="step_form__field_container">

                @if(!isset(auth()->user()->name))
                    <div class="step_form__full_field">
                        <label for="name">
                            Nom & prénom <span>({{ __('Optionnel') }})</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               class=""
                               value="{{ auth()->user()->name ?? old('name') }}"
                               placeholder="{{ __('Entrez votre nom et votre prénom') }}"
                               wire:model="name">

                        @error('name')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                @endif

                <div class="step_form__semi_field">
                    <label for="profilpic">
                        Photo de profil <span>({{ __('Optionnel') }})</span>
                    </label>

                    <input type="file"
                           name="profilpic"
                           id="profilpic"
                           class=""
                           wire:model="profilpic">

                    @error('profilpic')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="step_form__semi_field">
                    <label for="bannerpic">
                        Photo de banière <span>({{ __('Optionnel') }})</span>
                    </label>

                    <input type="file"
                           name="bannerpic"
                           id="bannerpic"
                           class=""
                           wire:model="bannerpic">

                    @error('bannerpic')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="step_form__button_container">
                <input type="submit"
                       value="{{ __('Étape suivante') }}"
                       class="principal_button"
                       wire:click.debounce.2000ms="redirectToSecondStep">

                <a href=""
                   class="secondary_button">
                    {{ 'Passer toutes les étapes' }}
                </a>
            </div>
        </form>
    </div>


    @if($statutMessage)
        <div>
            <span>{{ $statutMessage }}</span>
        </div>
    @endif
</div>
