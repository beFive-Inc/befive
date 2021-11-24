<nav class="steps__nav nav">
    <h2 aria-level="2" role="heading" class="sr_only">
        {{ __('steps.title') }}
    </h2>

    <ol class="nav__list">
        <x-item :active="$firstStep">
            {{ __('steps.first.nav.title') }}
        </x-item>

        <x-item :active="$secondStep">
            {{ __('steps.second.nav.title') }}
        </x-item>

        <x-item :active="$thirdStep">
            {{ __('steps.third.nav.title') }}
        </x-item>
    </ol>
</nav>
