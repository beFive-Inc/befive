<x-auth-layout>
    <x-slot name="title">
        {{ __('Connexion à Be Five') }}
    </x-slot>


    <x-slot name="metaData">

    </x-slot>


    <x-slot name="content">
        <div class="auth__right_container">
            <div class="auth__logo_container">
                <img src="{{ asset('parts/logo/befive_logo_white_background.svg') }}" class="auth__logo"
                     alt="Logo de befive">

                <p class="auth__slogan_phrase">
                    {{ __('messages.slogan.phrase') }}
                </p>
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
                                <div class="auth_form__mega_field">
                                    <div>
                                        <label for="email" title="{{ __('Veuillez inscrire votre adresse e-mail') }}">
                                            {{ __('auth.field.email') }}
                                        </label>
                                    </div>
                                    <div class="input_anim">
                                        <input type="email"
                                               id="email"
                                               name="email"
                                               value="{{ old('email') }}"
                                               placeholder="{{ __('auth.field.email') }}">
                                        <span></span>
                                    </div>

                                    @error('email')
                                    <span class="error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>

                                <div class="auth_form__mega_field">
                                    <div>
                                        <label for="password"
                                               title="{{ __('Veuillez inscrire votre mot de passe') }}">
                                            {{ __('auth.field.password') }}
                                        </label>
                                    </div>

                                    <div class="input_anim">
                                        <input type="password"
                                               id="password"
                                               name="password"
                                               placeholder="********">
                                        <span></span>
                                    </div>

                                    @error('password')
                                    <span class="error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="auth_form__button_container">
                                <input type="submit"
                                       value="{{ __('auth.sign-in.btn') }}"
                                       class="principal_button mb-625"
                                       disabled>

                                <a href="{{ route('password.request') }}" class="forgot_link">
                                    {!! __('passwords.forget') !!}
                                </a>

                                <hr class="my-1">

                                <p>
                                    {!!  __('passwords.not.account') !!}
                                </p>

                                <a href="{{ route('register') }}"
                                   class="secondary_button mt-1">
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
