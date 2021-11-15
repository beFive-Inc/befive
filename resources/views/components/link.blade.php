@php
    $classes = ($active ?? false)
                ? 'nav__list_item active'
                : 'nav__list_item';
@endphp


<li {{ $attributes->merge(['class' => $classes]) }}>
    <a href="{{ $href }}" class="nav__list_href">
        {{ $slot }}
    </a>
</li>
