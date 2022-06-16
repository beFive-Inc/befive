<x-auth-layout>
    <x-slot name="title">
        {{ __('auth.sign-up.title') }}
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
                        {!! __('auth.sign-up.hook.title') !!}
                    </h2>

                    <p class="hook__text">
                        {!! __('auth.sign-up.hook.text') !!}
                    </p>
                </section>

                <form action="{{ route('register') }}"
                      method="post"
                      class="form">
                    @csrf

                    <x-field type="text"
                             name="pseudo"
                             id="pseudo"
                             :notice="__('auth.pseudo.notice')"
                             :labeltext="__('auth.pseudo.label')"
                             :placeholder="__('auth.pseudo.placeholder')"
                             :autocomplete="false"
                             :required="true">
                    </x-field>

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
                             :required="true" :additionnal="true">
                    </x-field>

                    <div class="actions">
                        <input type="submit"
                               value="{{ __('auth.sign-up') }}"
                               class="btn btn-primary">

                        <p class="actions__secondary">
                            <x-default-link :href="route('login')">
                                {!!  __('auth.account') !!}
                            </x-default-link>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="script"></x-slot>
</x-auth-layout>
