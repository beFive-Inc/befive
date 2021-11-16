<nav class="steps__nav nav">
    <h2 aria-level="2" role="heading" class="sr_only">
        {{ 'Étapes d\'inscription' }}
    </h2>

    <ol class="nav__list">
        <x-item :active="request()->routeIs('step.first') ||
                         request()->routeIs('step.second') ||
                         request()->routeIs('step.third')">
            {{ __('Personnalisation') }}
        </x-item>
        <x-item :active="request()->routeIs('step.second') ||
                         request()->routeIs('step.third')">
            {{ __('Jeux') }}
        </x-item>
        <x-item :active="request()->routeIs('step.third')">
            {{ __('Équipe') }}
        </x-item>
    </ol>
</nav>
