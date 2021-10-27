<x-layout>
    <x-slot name="title">
        {{ __('Be Five') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <x-friend-list :friends="$friends"></x-friend-list>
    </x-slot>



    <x-slot name="script">

    </x-slot>
</x-layout>
