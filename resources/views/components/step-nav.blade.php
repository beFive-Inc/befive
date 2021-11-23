<nav class="steps__nav nav">
    <h2 aria-level="2" role="heading" class="sr_only">
        {{ 'Étapes d\'inscription' }}
    </h2>

    <ol class="nav__list">
        <x-item :active="$firstStep">
            {{ __('Personnalisation') }}
        </x-item>

        <x-item :active="$secondStep">
            {{ __('Jeux') }}
        </x-item>

        <x-item :active="$thirdStep">
            {{ __('Équipe') }}
        </x-item>
    </ol>
</nav>
