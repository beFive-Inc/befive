<x-auth-layout>
    <x-slot name="title">
        {{ __('Connexion à Be Five') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <div class="auth">
            <div class="auth__linear_position">
                <div class="auth__linear_gradient"></div>
            </div>
            <div class="auth__preview_card preview_card">
                <article class="preview_card__item item">
                    <h2 aria-level="2" role="heading" class="item__title">
                        {{ __('Prévisualisation de votre carte') }}
                    </h2>

                    <section class="user_card">

                    </section>
                </article>
            </div>

            <div class="auth__right_container">
                <div class="auth__logo_container">
                    <img src="{{ asset('parts/logo/befive_logo_white_background.svg') }}" class="auth__logo" alt="Logo de befive">
                </div>


                <div class="auth__form_container">
                    <div class="auth__form_carrousel_overflow">
                        <div class="auth__form_carrousel">
                            <form action="{{ route('login') }}"
                                  method="post"
                                  class="auth__auth_form auth_form"
                                  id="check">
                                @csrf

                                <p class="auth_form__title">
                                    {{ __('auth.sign-in.title') }}
                                </p>

                                <div class="auth_form__field_container">
                                    <div class="auth_form__semi_field">
                                        <div>
                                            <label for="email" title="{{ __('Veuillez inscrire votre adresse e-mail') }}">
                                                {{ __('auth.field.email') }}
                                            </label>
                                        </div>

                                        <input type="email"
                                               id="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="{{ __('auth.field.email') }}">

                                        @error('email')
                                            <span class="error">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="auth_form__semi_field">
                                        <div>
                                            <label for="password"
                                                   title="{{ __('Veuillez inscrire votre mot de passe') }}">
                                                {{ __('auth.field.password') }}
                                            </label>
                                        </div>

                                        <input type="password"
                                               id="password"
                                               name="password"
                                               placeholder="********">

                                        @error('password')
                                            <span class="error">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="auth_form__button_container">
                                    <a href="{{ route('password.request') }}">
                                        {!! __('passwords.forget') !!}
                                    </a>
                                    <input type="submit"
                                           value="{{ __('auth.sign-in.btn') }}"
                                           class="principal_button"
                                           disabled>
                                    <p>
                                        {{ __('messages.or') }}
                                    </p>
                                    <a href="{{ route('register') }}"
                                       class="secondary_button">
                                        {{ __('auth.sign-up.btn') }}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </x-slot>



    <x-slot name="script">
        <script src="{{ asset('js/formcheck.js') }}"></script>
    </x-slot>
</x-auth-layout>
