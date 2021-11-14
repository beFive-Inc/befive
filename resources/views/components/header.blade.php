<header class="header">
    <h1 class="header__title" role="heading" aria-level="1">
        <span class="sr_only">{{ __('Be Five, réseau social pour gamer') }}</span>
        <img class="header__logo" src="{{ asset('/storage/images/logo/befive_logo_white_background.svg') }}" alt="{{ __('Logo de Be Five') }}">
    </h1>

    <form action="/search" method="get" class="header__form form">
        <button class="form__btn">
            <img src="" alt>
        </button>
        <div class="form__search_container">
            <label for="search" class="sr_only" aria-hidden="{{ __('Rechercher un joueur') }}">{{ __('Rechercher') }}</label>
            <input type="search" id="search" class="form__search" name="search" placeholder="{{ __('Rechercher un joueur') }}">
        </div>
    </form>
</header>
