<header class="header">
    <h1 class="header__title"
        role="heading"
        aria-level="1">
        <a href="{{ route('homepage') }}">
            <span class="sr_only">
                {{ __('Be Five Chat') }}
            </span>
            <img class="header__logo"
                 src="{{ asset('/parts/logo/be-five-chat-logo.svg') }}"
                 alt="{{ __('Logo de Be Five') }}">
        </a>
    </h1>

    <div class="actions">
        <div class="notification dropdown-center">
            <livewire:notification :request-friends="$requestFriends" :request-canals="$requestCanals"/>
        </div>
        <div class="message-create">
            <a href="{{ route('chatroom.create') }}" type="button" class="modal-btn" data-bs-toggle="modal" data-bs-target="#createGroup">
                <span class="sr_only">{{ __('app.create.conversation') }}</span>
            </a>

            <!-- Create Conversation Modal -->
            <div class="modal fade" id="createGroup" tabindex="-1" aria-labelledby="createGroup" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content modal-special-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <livewire:chatroom-create :friend-list="$friends" :all-chatroom="$chatrooms"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-menu">
            <a href="{{ route('menu') }}"
               type="button"
               class="dropdown-btn status {{ Str::slug(auth()->user()->type->name) }}"
               id="dropdownMenuClickableInside"
               data-bs-toggle="dropdown"
               data-bs-auto-close="outside"
               aria-expanded="false">
                <div class="img">
                    <img src="{{ $medias->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" alt>
                </div>
            </a>
            <nav role="navigation">
                <h2 aria-level="2" role="heading" class="sr_only">
                    {{ __('app.navigation') }}
                </h2>
                <ul class="dropdown-menu menu" aria-labelledby="dropdownMenuClickableInside">
                    <li class="dropdown-user">
                        <a href="{{ route('user.edit') }}" class="dropdown-user__see">
                            <span class="sr_only">{{ __('user.see') }}</span>
                        </a>
                        <div class="status-show status {{ Str::slug(auth()->user()->type->name) }}">
                            <div class="dropdown-user__img">
                                <img src="{{ $medias->last()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" alt>
                            </div>
                        </div>
                        <div class="dropdown-user__info">
                            <p class="dropdown-user__info__pseudo">
                                {{ auth()->user()->pseudo }}
                            </p>
                            <p class="dropdown-user__info__hashtag">
                                {{ __('#') . auth()->user()->hashtag }}
                            </p>
                        </div>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="menu__item dropdown-item menu__friends" href="{{ route('friends.index') }}">Amis</a></li>
                    <li><a class="menu__item dropdown-item menu__archive" href="{{ route('chatroom.index.archive') }}">Messages archivés</a></li>
                    <li><h3 aria-level="3" role="heading" class="dropdown-header">Discover</h3></li>
                    <li><a class="menu__item dropdown-item menu__discover" href="{{ route('discover') }}">Découvrir de nouveaux canaux</a></li>
                    <li><h3 aria-level="3" role="heading" class="dropdown-header">Profil</h3></li>
                    <li>
                        <div class="btn-group">
                            <a href="{{ route('user.status') }}"
                               type="button"
                               class="menu__item dropdown-item menu__status"
                               data-bs-toggle="dropdown"
                               data-bs-auto-close="outside"
                               aria-expanded="false">
                                Statut
                            </a>
                            <livewire:status/>
                        </div>
                    </li>
                    <li><a class="menu__item dropdown-item menu__edit-profile" href="{{ route('user.edit') }}">Modifier son profil</a></li>
                    <li><h3 aria-level="3" role="heading" class="dropdown-header">Compte</h3></li>
                    <li><a class="menu__item dropdown-item menu__settings" href="#">Paramètres du compte</a></li>
                    <li><a class="menu__item dropdown-item menu__rgpd" href="#">Mentions légales et politiques</a></li>
                    <li>
                        <form class="" method="post" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item menu__item menu__disconnect menu__danger">Se déconnecter</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</header>
