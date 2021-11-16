@php
    $classes = ($active ?? false)
                ? 'active'
                : '';
@endphp


<li class="nav__list_item">
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>
