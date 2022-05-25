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

    <div class="user_card__profilpic">
        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ auth()->user()->getMedia('user_profile_pic')?->last()?->getFullUrl() }}" alt>
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Amis</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="{{ route('friends.index') }}">Amis</a></li>
            <li><a class="dropdown-item" href="#">Messages archivés</a></li>
            <li><h6 class="dropdown-header">Profil</h6></li>
            <li><a class="dropdown-item" href="#">Statut</a></li>
            <li><a class="dropdown-item" href="#">Modifier son profil</a></li>
            <li><h6 class="dropdown-header">Compte</h6></li>
            <li><a class="dropdown-item" href="#">Paramètres du compte</a></li>
            <li><a class="dropdown-item" href="#">Mentions légales et politiques</a></li>
            <li>
                <form method="post" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Se déconnecter</button>
                </form>
            </li>
        </ul>
    </div>

</header>
