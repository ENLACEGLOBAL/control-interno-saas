@props(['href' => null, 'variant' => 'primary'])

@php
    $base = 'inline-flex items-center justify-center gap-1.5 rounded-lg px-4 py-2 text-sm font-semibold shadow-sm transition focus:outline-none focus:ring-2 focus:ring-offset-2 active:scale-[.99]';
    $variants = [
        'primary'   => 'bg-slate-900 text-white hover:bg-slate-800 focus:ring-slate-900/20',
        'secondary' => 'border border-slate-300 bg-white text-slate-700 hover:bg-slate-50 focus:ring-slate-900/10',
        'accent'    => 'bg-cyan-600 text-white hover:bg-cyan-500 focus:ring-cyan-500/30',
    ];
    $classes = $base.' '.($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>{{ $slot }}</button>
@endif
