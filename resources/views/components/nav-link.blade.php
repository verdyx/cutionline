@props(['active'])

@php
$classes = ($active ?? false)
            ? 'waves-effect mm-active'
            : 'waves-effect';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} data-turbolinks-action="replace">
    {{ $slot }}
</a>
