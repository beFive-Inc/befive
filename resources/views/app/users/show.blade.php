<x-layout>
    <x-slot name="title">
        {{ "$user->pseudo  #$user->hashtag"  }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <div style="grid-column: 1 / 10">
            <x-user-card></x-user-card>
        </div>

        <div style="grid-column: 1 / 5">
            <div>
                <ul>
                    @foreach($user->getGames() as $game)
                        <li>{{ $game->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div style="grid-column: 5 / 10">
            <form action="">
                <input type="text" placeholder="Coucou" style="width: 100%">
            </form>
        </div>
    </x-slot>



    <x-slot name="script">

    </x-slot>
</x-layout>
