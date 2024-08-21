
@php
    $classes = "text-sm text-gray-500 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 font-semibold";
@endphp

{{-- merge() unira todos los atributos que le pase al enlace --}}
<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>