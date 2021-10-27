<section class="friend_list">
    <h2 aria-level="2" role="heading" class="friend_list__title">
        {{ __('Liste d\'amis') }}
    </h2>

    @foreach($friends as $friend)
        <x-friend :friend="$friend"></x-friend>
    @endforeach
</section>
