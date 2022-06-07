<div class="form__field">
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

    @error($name)
        <span class="error">
            {{ $message }}
        </span>
    @enderror

    {{ $slot }}
</div>
