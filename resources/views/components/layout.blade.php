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
    {{ $metaData }}
</head>
<body>
    <h1 aria-level="1" role="heading" aria-hidden="true" class="sr-only">
        {{ __('Be Five, premier réseau social pour gamer') }}
    </h1>
    <form action="{{ route('logout') }}" method="post">
        @csrf

        <input type="submit" value="Se déconnecter">
    </form>
    <!-- Header -->
    <x-header></x-header>

    <!-- Contenu -->
    <livewire:friend-list />
    {{ $content }}


    <!-- Différents scripts -->
    @livewireScripts
    {{ $script }}
</body>
</html>
