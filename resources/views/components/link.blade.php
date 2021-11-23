@php
    $classes = ($active ?? false)
                ? 'nav__list_item active'
                : 'nav__list_item';
@endphp


<li class="nav__list_item">
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
