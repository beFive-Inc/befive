<x-layout :friends="$friends" :request-friends="$requestFriends" :medias="$medias" :chatrooms="$chatrooms">
    <x-slot name="title">
        {{ __('Be Five | Homepage') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <div class="accordion">
            @if($canals->count())
                <section class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                            {{ __('app.canals') }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                        <div class="accordion-body accordion-canal">
                            @foreach($canals as $chatroom)
                                <livewire:canal :chatroom="$chatroom"/>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
            @if($groups->count())
                <section class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                            {{ __('app.groups') }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingTwo">
                        <div class="accordion-body">
                            @foreach($groups as $chatroom)
                                <livewire:group-message :chatroom="$chatroom" :friends="$friends" :all-chatrooms="$chatrooms"/>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
            @if($conversations->count())
                <section class="accordion-item">
                    <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
                            {{ __('app.conversations') }}
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingThree">
                        <div class="accordion-body">
                            @foreach($conversations as $chatroom)
                                <livewire:conversation-message :chatroom="$chatroom" :friends="$friends" :all-chatrooms="$chatrooms"/>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </x-slot>



    <x-slot name="script">
        @foreach($chatrooms as $chatroom)
            <script>
                Echo.join(`chatroom.<?= $chatroom->uuid ?>`)
                    .here(users => {
                        console.log(users.length + ' utilisateurs')
                    })
                    .joining(user => {
                        console.log(user.name + ' a rejoint')
                    })
                    .leaving(user => {
                        console.log(user.name + ' est parti')
                    })
                    .listen('MessageSent', (e) => {
                        window.livewire.emit('messageSent')
                    });
            </script>
        @endforeach

        <script>
            Echo.join(`add-friend.1`)
                .listen('FriendAdded', (e) => {
                    console.log(e)
                    window.livewire.emit('friendAdded');
                });
        </script>
    </x-slot>
</x-layout>
