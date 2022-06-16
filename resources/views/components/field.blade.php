<div class="form__field">
    <div class="form__field-container">
        <label for="{{ $id }}"
               data-bs-toggle="tooltip"
               data-bs-placement="top"
               title="{{ $notice }}"
               class="form__label">
            {{ $labeltext }}
        </label>

        <input type="{{ $type }}"
               id="{{ $id }}"
               name="{{ $name }}"
               class="form__input @error($name){{ 'error' }}@enderror"
               value="{{ old($name) ?? $value }}"
               placeholder="{{ $placeholder }}"
               autocomplete="{{ $autocomplete ?? 'off' }}"
            {{ $required ? 'required' : '' }}>

        @if($additionnal)
            <span class="btn-see"></span>
        @endif
    </div>

    @error($name)
        <span class="error">
            {{ $message }}
        </span>
    @enderror

    {{ $slot }}
</div>
