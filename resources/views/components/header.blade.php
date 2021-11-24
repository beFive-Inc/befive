<header class="header">
    <h1 class="header__title"
        role="heading"
        aria-level="1">
        <span class="sr_only">
            {{ __('Be Five, réseau social pour gamer') }}
        </span>
        <img class="header__logo"
             src="{{ asset('/parts/logo/befive_logo_white_background.svg') }}"
             alt="{{ __('Logo de Be Five') }}">
    </h1>

    <form action="/search"
          method="get"
          class="header__form form">
        <button class="form__btn">
            <img src="{{ asset('parts/icons/outline/search-normal-1.svg') }}"
                 alt>
        </button>
        <div class="form__search_container">
            <label for="search"
                   class="sr_only"
                   aria-hidden="{{ __('friends.field.search.placeholder') }}">
                {{ __('friends.field.search') }}
            </label>
            <input type="search"
                   id="search"
                   class="form__search"
                   name="search"
                   placeholder="{{ __('friends.field.search.placeholder') }}">
        </div>
    </form>

    <form action="{{ route('logout') }}"
          method="post"
          class="disconnect">
        @csrf

        <input type="submit"
               value="Se déconnecter">
    </form>
</header>
