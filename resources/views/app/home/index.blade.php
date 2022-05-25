<x-layout>
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <livewire:search-bar/>

        <div class="accordion">
            @foreach($chatrooms as $chatroom)
                @php $lastChatroom = $lastChatroom ?? $chatroom @endphp
                @php $nextChatroom = $chatrooms->take($loop->iteration + 1)->reverse()->first() @endphp
                @php $type = $chatroom->isCanal ?? $chatroom->isGroup @endphp

                @if($chatroom->isCanal)
                    @if($chatroom->isCanal != $lastChatroom->isCanal || $loop->first)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                                    {{ __('Canaux') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                                <div class="accordion-body">
                    @endif

                                    <x-canal :chatroom="$chatroom"></x-canal>

                    @if($chatroom->isCanal != $nextChatroom->isCanal || $loop->last)
                                </div>
                            </div>
                        </div>
                    @endif
                @elseif($chatroom->isGroup)
                    @if($chatroom->isGroup != $lastChatroom->isgroup || $loop->first)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                                    {{ __('Groupe') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                    @endif

                                    <x-group-message :chatroom="$chatroom"></x-group-message>

                    @if($chatroom->isGroup != $nextChatroom->isgroup || $loop->last)
                                </div>
                            </div>
                        </div>
                    @endif
                @else
                    @if($chatroom->isConversation != $lastChatroom->isConversation || $loop->first)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                                    {{ __('Amis') }}
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                                <div class="accordion-body">
                    @endif

                                    <x-friend-message :chatroom="$chatroom"></x-friend-message>

                    @if($chatroom->isConversation != $nextChatroom->isConversation || $loop->last)
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                @php $lastChatroom = $chatroom @endphp
            @endforeach
        </div>
    </x-slot>



    <x-slot name="script">

    </x-slot>
</x-layout>
