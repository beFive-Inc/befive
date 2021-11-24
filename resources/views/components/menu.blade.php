<div class="menu">
    <x-user-card></x-user-card>

    <x-team-card></x-team-card>

    <nav role="navigation" class="menu__nav nav">
        <h2 aria-level="2" role="heading" class="sr_only">
            {{ __('navigation.title') }}
        </h2>

        <ul class="nav__list">
            <x-link :href="route('homepage')"
                    :active="request()->routeIs('homepage')">
                <span class="nav__home"></span>{{ __('navigation.home') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__profil" ></span>{{ __('navigation.profil') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__team"></span>{{ __('navigation.team') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__friends"></span>{{ __('navigation.friends') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__message"></span>{{ __('navigation.message') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__video"></span>{{ __('navigation.video') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__games"></span>{{ __('navigation.games') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__tournament"></span>{{ __('navigation.tournament') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__classement"></span>{{ __('navigation.classement') }}
            </x-link>
            <x-link href=""
                    active="">
                <span class="nav__settings"></span>{{ __('navigation.settings') }}
            </x-link>
        </ul>
    </nav>


</div>
