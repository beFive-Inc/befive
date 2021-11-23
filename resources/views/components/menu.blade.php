<div class="menu">
    <x-user-card></x-user-card>

    <x-team-card></x-team-card>

    <nav role="navigation" class="menu__nav nav">
        <h2 aria-level="2" role="heading" class="sr_only">
            {{ __('Navigation principale') }}
        </h2>

        <ul class="nav__list">
            <x-link :href="route('homepage')"
                    :active="request()->routeIs('homepage')">
                {{ __('Accueil') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Profil') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Équipe') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Amis') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Mes Messages') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Vidéos') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Jeux') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Tournoi') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Classement') }}
            </x-link>
            <x-link href=""
                    active="">
                {{ __('Paramètres') }}
            </x-link>
        </ul>
    </nav>


</div>
