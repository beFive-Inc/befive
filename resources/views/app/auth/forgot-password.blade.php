<x-auth-layout>
    <x-slot name="title">
        {{ __('Connexion à Be Five') }}
    </x-slot>


    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <div class="auth__right_container">
            <div class="auth__logo_container">
                <img src="{{ asset('parts/logo/befive_logo_white_background.svg') }}"
                     class="auth__logo"
                     alt="Logo de befive">

                <p class="auth__slogan_phrase">
                    {{ __('messages.slogan.phrase') }}
                </p>
            </div>


            <div class="auth__form_container">
                <div class="auth__form_carrousel_overflow">
                    <div class="auth__form_carrousel">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="{{ route('password.email') }}"
                              method="post"
                              class="auth__auth_form auth_form"
                              id="check">
                            @csrf

                            <p class="auth_form__title">
                                {{ __('Reset Password') }}
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
                            </div>

                            <div class="auth_form__button_container">
                                <input type="submit"
                                       value="{{ __('Send Password Reset Link') }}"
                                       class="principal_button mb-625"
                                       disabled>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="script">

    </x-slot>
</x-auth-layout>
