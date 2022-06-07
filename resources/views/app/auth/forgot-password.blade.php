<x-auth-layout>
    <x-slot name="title">
        {{ __('Connexion à Be Five') }}
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

                <form action="{{ route('password.email') }}"
                      method="post"
                      class="form">
                    @csrf

                    <x-field type="email"
                             name="email"
                             id="email"
                             :notice="__('auth.email.notice')"
                             :labeltext="__('auth.email.label')"
                             :placeholder="__('auth.email.placeholder')"
                             :autocomplete="true"
                             :required="true">
                    </x-field>

                    <div class="actions">
                        <input type="submit"
                               value="{{ __('passwords.send') }}"
                               class="btn btn-primary">
                    </div>
                </form>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>
    </x-slot>

    <x-slot name="script"></x-slot>
</x-auth-layout>
