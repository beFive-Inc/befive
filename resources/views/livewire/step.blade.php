<div class="steps">
    @if($steps['second']['change-css'])
        <article class="steps__preview_card preview_card ">
            <div class="preview_card__logo">
                <img src="{{ asset('storage/images/logo/befive_logo_white_background.svg') }}" alt="Logo de Befive">
            </div>
            <h2 aria-level="2" role="heading" class="preview_card__title">
                {{ __('Prévisualisation de vos jeux') . ' - ' . $myGames->count() }}
            </h2>

            <section class="game_card">
                @foreach($myGames as $game)
                    <p>
                        {{ $game['name'] }}
                    </p>
                @endforeach
            </section>
        </article>
    @endif
    @if($steps['first']['nav'])
        <article class="steps__preview_card preview_card {{ $steps['second']['change-css'] ? 'sr_only' : '' }}">
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
    @endif


    <div class="steps__form_container">
        <x-step-nav :firststep="$steps['first']['nav']"
                    :secondstep="$steps['second']['change-css']"
                    :thirdstep="$steps['third']['nav']"></x-step-nav>

        <div class="steps__form_carrousel_overflow">
            <div class="steps__form_carrousel {{ $steps['second']['nav'] ? 'form_carrousel-2' : '' }}">
                @if($steps['first']['nav'])
                    <form action="{{ route('step.first.store') }}"
                          method="post"
                          enctype="multipart/form-data"
                          class="steps__step_form step_form
                                 {{ $steps['second']['show'] ? 'step_form_second' : '' }}
                                 {{ $steps['second']['change-css'] ? 'step_form_better_render' : '' }}"
                          wire:submit.prevent="save">
                        @csrf


                        <p class="step_form__progression">
                            {{ __('Étape') . ' ' . "$countStep/$totalStep" }}
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
                                   wire:click.debounce.50ms="getSecondStep"
                                   wire:click.debounce.1000ms="changeCssValue">

                            <a href="{{ route('homepage') }}"
                               class="secondary_button"
                               wire:click.prevent="skipAllStep">
                                {{ 'Passer toutes les étapes' }}
                            </a>
                        </div>
                    </form>
                @endif

                @if($steps['second']['nav'])
                    <form action="{{ route('step.first.store') }}"
                          method="post"
                          class="steps__step_form step_form {{ $steps['second']['show'] ? 'step_form_second' : '' }}">
                        @csrf


                        <p class="step_form__progression">
                            {{ __('Étape') . ' 2/3' }}
                        </p>

                        <p class="step_form__title">
                            {{ __('Choississez vos jeux') }}
                        </p>

                        <div class="step_form__field_container">
                            <div class="step_form__mega_field">
                                <label for="game">
                                    Rechercher un jeu
                                </label>

                                <div>
                                    <input type="search"
                                           name="search"
                                           id="search"
                                           placeholder="Rechercher un jeux à ajouter"
                                           wire:model.debounce.200ms="query">


                                    <section class="step_form__games_card">
                                        <h2 aria-level="2" role="heading" class="sr_only">
                                            {{ __('Jeux') }}
                                        </h2>

                                        @if($games)
                                            @foreach($games as $game)
                                                <article class="games_card__game game {{ $this->checkGameIsInArray($game->id) ? 'checked' : '' }}" wire:click.prevent="addGamesToArray({{ $game->id }})">
                                                    <h3 aria-level="3" role="heading" class="game__title">
                                                        {{ $game->name }}
                                                    </h3>
                                                </article>
                                            @endforeach
                                        @endif
                                    </section>
                                </div>

                                @error('bannerpic')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="step_form__button_container">
                            <input type="submit"
                                   value="{{ __('Étape suivante') }}"
                                   class="principal_button">

                            <a href="{{ route('homepage') }}"
                               class="secondary_button"
                               wire:click.prevent="skipAllStep">
                                {{ 'Passer toutes les étapes' }}
                            </a>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        @if($stepFeedBack['message'])
            <div class="steps__message message">
                <div class="message__container">
                    <span class="message__text message__{{ $stepFeedBack['status'] }}">
                        {{ $stepFeedBack['message'] }}
                    </span>
                </div>
            </div>
        @endif
    </div>

</div>
