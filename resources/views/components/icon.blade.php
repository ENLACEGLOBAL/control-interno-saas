@props(['name', 'stroke' => '1.8'])

<svg {{ $attributes->merge(['class' => 'h-5 w-5 shrink-0']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="{{ $stroke }}" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! \App\Support\Navigation::icon($name) !!}</svg>
