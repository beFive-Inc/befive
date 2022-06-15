<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :requested-canals="$requestCanals">
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>

    <x-slot name="metaData">

    </x-slot>

    <x-slot name="content">
        <nav class="auth special-auth">
            <h2 class="sr_only" role="heading" aria-level="2">
                {{ __('app.navigation') }}
            </h2>
            <ul class="dropdown-menu menu page-menu show" aria-labelledby="dropdownMenuClickableInside">
                <li class="dropdown-user">
                    <a href="{{ route('user.edit') }}" class="dropdown-user__see">
                        <span class="sr_only">{{ __('user.see') }}</span>
                    </a>
                    <div class="dropdown-user__img">
                        <img src="{{ $medias->first()?->getUrl() ?? asset('parts/user/profile_img.webp') }}" alt>
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
                <li><h3 class="dropdown-header">Profil</h3></li>
                <li>
                    <div class="btn-group dropstart">
                        <a href="{{ route('user.status') }}"
                           type="button"
                           class="menu__item dropdown-item menu__status">
                            Statut
                        </a>
                    </div>
                </li>
                <li><a class="menu__item dropdown-item menu__edit-profile" href="{{ route('user.edit') }}">Modifier son profil</a></li>
                <li><h3 class="dropdown-header">Compte</h3></li>
                <li>
                    <form class="" method="post" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item menu__item menu__disconnect menu__danger">Se déconnecter</button>
                    </form>
                </li>
            </ul>
        </nav>
    </x-slot>

    <x-slot name="script">
        <script>
            Echo.channel("user.{{ auth()->id() }}")
                .listen('FriendAdded', (e) => {
                    window.livewire.emit('friendAdded');
                });
        </script>
    </x-slot>
</x-layout>
