<div>
    <div class="">
        @foreach($messages as $msg)
            <x-message :message="$msg"></x-message>
        @endforeach
    </div>

    <form action="{{ route('chatroom.create') }}" method="post" wire:submit.prevent="send">
        @csrf
        <input type="hidden" name="member_id" value="{{ $authIngroup->id }}">
        <input type="text" name="message"
               wire:model.debounce.500ms="message"
               wire:keyup.debounce.300ms="check">

        <input type="submit" value="Envoyer">
    </form>
</div>
