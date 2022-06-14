<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Titre de la page -->
    <title>{{ $title }}</title>


    <!-- Métadonnées, css et javascript -->
    @livewireStyles
    <script src="{{ asset('/js/bootstrap.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    {{ $metaData }}
</head>
<body>
    <h1 aria-level="1" role="heading" aria-hidden="true" class="sr_only">
        {{ __('Be Five, premier réseau social pour gamer') }}
    </h1>
    <!-- Header -->
    <x-header :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms" :request-canals="$requestedCanals"></x-header>

    <!-- Contenu -->
    <main class="main">
        <div class="searchbar pointer" data-bs-toggle="modal" data-bs-target="#searchBar">
            <div class="form special">
                <div class="form__btn">
                    <img src="{{ asset('parts/icons/outline/search-normal-1.svg') }}"
                         alt>
                </div>
                <div class="form__search_container">
                    <p class="form__search">
                        {{ __('app.search.placeholder') }}
                    </p>
                </div>
            </div>
        </div>

        <div id="searchBar"
             class="modal modal-fade"
             data-bs-backdrop="static"
             data-bs-keyboard="false"
             tabindex="-1"
             aria-labelledby="staticBackdropLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content modal-special-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <livewire:search-bar :own-friends="$friends"/>
                    </div>
                </div>
            </div>
        </div>

        {{ $content }}
    </main>


    <!-- Différents scripts -->
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    {{ $script }}
</body>
</html>
