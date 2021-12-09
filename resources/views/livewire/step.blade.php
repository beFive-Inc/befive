<div class="auth step__auth">
    <div class="auth__linear_position">
        <div class="auth__linear_gradient"></div>
    </div>
    <div class="auth__preview_card preview_card">
        <article class="preview_card__item item {{ $steps['second']['show'] ? 'item_hide' : '' }}">
            <h2 aria-level="2" role="heading" class="item__title">
                {{ __('steps.first.preview.title') }}
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

        <article class="preview_card__item item">
            <h2 aria-level="2" role="heading" class="item__title">
                {{ __('steps.second.preview.title') . ' - ' . $myGames->count() }}
            </h2>

            <section class="game_card">
                @foreach($myGames as $game)
                    <p>
                        {{ $game['name'] }}
                    </p>
                @endforeach
            </section>
        </article>
    </div>


    <div class="auth__form_container">
        <x-step-nav :firststep="$steps['first']['show']"
                    :secondstep="$steps['second']['show']"
                    :thirdstep="$steps['third']['show']"></x-step-nav>

        <div class="auth__form_carrousel_overflow">
            <div class="auth__form_carrousel form_carrousel-2">
                <form action="{{ route('step.first.store') }}"
                      method="post"
                      enctype="multipart/form-data"
                      class="auth__auth_form auth_form
                             {{ $steps['second']['show'] ? 'auth_form_second auth_form_better_render' : '' }}"
                      wire:submit.prevent="saveFirstStep">
                    @csrf


                    <p class="auth_form__progression">
                        {{ __('steps.singular.name') . ' ' . "$countStep/$totalStep" }}
                    </p>

                    <p class="auth_form__title">
                        {{ __('steps.first.title') }}
                    </p>

                    <div class="auth_form__field_container">

                        @if(!isset(auth()->user()->name))
                            <div class="auth_form__full_field">
                                <div>
                                    <label for="name">
                                        {{ __('steps.first.field.name.title') }} <span class="optional">{{ __('validation.optional') }}</span>
                                    </label>
                                </div>

                                <div class="input_anim">
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class=""
                                           value="{{ auth()->user()->name ?? old('name') }}"
                                           placeholder="{{ __('steps.first.field.name.placeholder') }}"
                                           title="{{ __('steps.first.field.name.placeholder') }}"
                                           wire:model="name">
                                    <span></span>
                                </div>

                                @error('name')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        @endif

                        <div class="auth_form__semi_field">
                            <div>
                                <label for="profilpic">
                                    {{ __('steps.first.field.profil-pic.title') }} <span class="optional">{{ __('validation.optional') }}</span>
                                </label>
                            </div>

                            <input type="file"
                                   name="profilpic"
                                   id="profilpic"
                                   accept="image/*"
                                   capture="user"
                                   wire:model="profilpic">

                            @error('profilpic')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="auth_form__semi_field">
                            <div>
                                <label for="bannerpic">
                                    {{ __('steps.first.field.banner-pic.title') }} <span class="optional">{{ __('validation.optional') }}</span>
                                </label>
                            </div>

                            <input type="file"
                                   name="bannerpic"
                                   id="bannerpic"
                                   accept="image/*"
                                   capture="environment"
                                   files
                                   wire:model="bannerpic">

                            @error('bannerpic')
                                <span class="error">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="auth_form__button_container">
                        <input type="submit"
                               value="{{ __('steps.step.next') }}"
                               class="principal_button">

                        <a href="{{ route('homepage') }}"
                           class="secondary_button"
                           wire:click.prevent="skipAllStep">
                            {{ __('steps.skip') }}
                        </a>
                    </div>
                </form>

                <form action="{{ route('step.second.store') }}"
                      method="post"
                      class="auth__auth_form auth_form {{ $steps['second']['show'] ? 'auth_form_second' : '' }}">
                    @csrf


                    <p class="auth_form__progression">
                        {{ __('steps.singular.name') . ' ' . "$countStep/$totalStep" }}
                    </p>

                    <p class="auth_form__title">
                        {{ __('steps.second.title') }}
                    </p>

                    <div class="auth_form__field_container">
                        <div class="auth_form__mega_field">
                            <label for="game">
                                {{ __('steps.second.field.search.title') }}
                            </label>

                            <div>
                                <input type="search"
                                       name="search"
                                       id="search"
                                       placeholder="{{ __('steps.second.field.search.placeholder') }}"
                                       title="{{ __('steps.second.field.search.placeholder') }}"
                                       wire:model.debounce.200ms="query">


                                <section class="auth_form__games_card">
                                    <h2 aria-level="2" role="heading" class="sr_only">
                                        {{ __('steps.second.nav.title') }}
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
                    <div class="auth_form__button_container">
                        <input type="submit"
                               value="{{ __('steps.step.next') }}"
                               class="principal_button">

                        <a href="{{ route('homepage') }}"
                           class="secondary_button"
                           wire:click.prevent="skipAllStep">
                            {{ __('steps.skip') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>

        @if($stepFeedBack['message'])
            <div class="auth__message message">
                <div class="message__container">
                    <span class="message__text message__{{ $stepFeedBack['status'] }}">
                        {{ $stepFeedBack['message'] }}
                    </span>
                </div>
            </div>
        @endif
    </div>

</div>
