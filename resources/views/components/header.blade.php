<header>
    <h1 role="heading" aria-level="1">
        {{ __('Be Five, réseau social pour gamer') }}
        <img src="{{ asset('/images/logo/befive_logo_white_background.svg') }}" alt="{{ __('Logo de Be Five') }}">
    </h1>

    <form action="/search" method="get">
        <div>
            <button>
                <img src="" alt>
            </button>
        </div>
        <div>
            <label for="search" class="sr-only" aria-hidden="{{ __('Rechercher un joueur') }}">{{ __('Rechercher') }}</label>
            <input type="search" id="search" name="search" placeholder="{{ __('Rechercher un joueur') }}">
        </div>
    </form>


</header>
