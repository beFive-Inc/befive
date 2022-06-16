<x-auth-layout>
    <x-slot name="title">
        {{ __('Réinitialisation du mot de passe') }}
    </x-slot>

    <x-slot name="metaData"></x-slot>

    <x-slot name="content">
        <div class="auth">
            <div class="auth__logo">
                <img src="{{ asset('parts/logo/be-five-chat-logo.svg') }}"
                     alt="{{ __('logo.alt') }}"
                     class="logo">
            </div>


            <div class="auth__form">
                <section class="hook">
                    <h2 aria-level="2"
                        role="heading"
                        class="hook__title">
                        {{ __('passwords.reset.title') }}
                    </h2>
                </section>

                <form action="{{ route('password.update') }}"
                      method="post"
                      class="form">
                    @csrf

                    <x-field type="email"
                             name="email"
                             id="email"
                             :notice="__('auth.email.notice')"
                             :labeltext="__('auth.email.label')"
                             :placeholder="__('auth.email.placeholder')"
                             :autocomplete="'email'"
                             :required="true">
                    </x-field>

                    <x-field type="password"
                             name="password"
                             id="password"
                             :notice="__('auth.password.notice')"
                             :labeltext="__('auth.password.label')"
                             :placeholder="__('auth.password.placeholder')"
                             :autocomplete="'new-password'"
                             :required="true"
                             :additionnal="true">
                    </x-field>

                    <x-field type="password"
                             name="password_confirmation"
                             id="password_confirmation"
                             :notice="__('auth.new.password.notice')"
                             :labeltext="__('auth.new.password.label')"
                             :placeholder="__('auth.new.password.placeholder')"
                             :autocomplete="'new-password'"
                             :required="true"
                             :additionnal="true">
                    </x-field>

                    <div class="actions">
                        <input type="submit"
                               value="{{ __('passwords.reset.title') }}"
                               class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="script"></x-slot>
</x-auth-layout>
