<header class="header">
    <h1 class="header__title"
        role="heading"
        aria-level="1">
        <a href="{{ route('homepage') }}">
            <span class="sr_only">
                {{ __('Be Five Chat') }}
            </span>
            <img class="header__logo"
                 src="{{ asset('/parts/logo/befive_logo_white_background.svg') }}"
                 alt="{{ __('Logo de Be Five') }}">
        </a>
    </h1>

    <div>
        <form action="{{ route('logout') }}"
              method="post"
              class="disconnect">
            @csrf

            <input type="submit"
                   value="Se déconnecter">
        </form>
    </div>
</header>
