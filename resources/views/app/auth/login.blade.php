<x-auth-layout>
    <x-slot name="title">
        {{ __('auth.sign-in.title') }}
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
                        {!! __('auth.sign-in.hook.title') !!}
                    </h2>

                    <p class="hook__text">
                        {!! __('auth.sign-in.hook.text') !!}
                    </p>
                </section>

                <form action="{{ route('login') }}"
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
                             :autocomplete="false"
                             :required="true"
                             :additionnal="true">

                        <div class="forgot_container">
                            <x-default-link :href="route('password.request')">
                                {!! __('passwords.forget') !!}
                            </x-default-link>
                        </div>
                    </x-field>

                    <div class="actions">
                        <input type="submit"
                               value="{{ __('auth.sign-in') }}"
                               class="btn btn-primary">

                        <p class="actions__secondary">
                            {!!  __('auth.not.account') !!}
                            <x-default-link :href="route('register')">
                                {{ __('auth.sign-up') }}
                            </x-default-link>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <x-slot name="script"></x-slot>
</x-auth-layout>
