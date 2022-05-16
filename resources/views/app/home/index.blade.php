<x-layout>
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <x-search-bar></x-search-bar>

        <div>
            @foreach($friends as $friend)
                <x-friend :friend="$friend"></x-friend>
            @endforeach
        </div>
    </x-slot>



    <x-slot name="script">

    </x-slot>
</x-layout>
