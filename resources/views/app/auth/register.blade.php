<x-layout>
    <x-slot name="title">
        {{ __('Inscription à Be Five') }}
    </x-slot>



    <x-slot name="metaData">

    </x-slot>



    <x-slot name="content">
        <form action="{{ route('register') }}" method="post" id="check">
            @csrf

            <div>
                <label for="pseudo" title="{{ __('Veuillez inscrire votre pseudo') }}">{{ __('Pseudo') }}</label>
                <input type="name" id="pseudo" name="pseudo" placeholder="DoeJohn" value="{{ old('pseudo') }}">

                @error('name')
                    <span aria-errormessage="{{ $message }}">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="email" title="{{ __('Veuillez inscrire votre adresse e-mail') }}">{{ __('Adresse e-mail') }}</label>
                <input type="email" id="email" name="email" placeholder="john.doe@gmail.com" value="{{ old('email') }}">

                @error('email')
                    <span aria-errormessage="{{ $message }}">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="password" title="{{ __('Veuillez inscrire votre mot de passe') }}">{{ __('Mot de passe') }}</label>
                <input type="password" id="password" name="password" placeholder="********">
                @error('password')
                    <span aria-errormessage="{{ $message }}">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button disabled title="{{ __('Se connecter') }}">
                    {{ __('Se connecter') }}
                </button>
            </div>
        </form>
    </x-slot>



    <x-slot name="script">
        <script src="{{ asset('js/formcheck.js') }}"></script>
    </x-slot>
</x-layout>
