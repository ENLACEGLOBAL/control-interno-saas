@props(['href' => null, 'variant' => 'primary', 'size' => 'md', 'icon' => null])

@php
    $base = 'inline-flex items-center justify-center gap-2 rounded-lg font-semibold shadow-sm transition focus:outline-none focus-visible:ring-2 focus-visible:ring-offset-2 active:scale-[.98] disabled:cursor-not-allowed disabled:opacity-50';
    $sizes = [
        'sm' => 'px-3 py-1.5 text-xs',
        'md' => 'px-4 py-2.5 text-sm',
    ];
    $variants = [
        'primary'   => 'bg-slate-900 text-white hover:bg-slate-800 focus-visible:ring-slate-900/30',
        'secondary' => 'border border-slate-300 bg-white text-slate-700 hover:border-slate-400 hover:bg-slate-50 focus-visible:ring-slate-900/10',
        'accent'    => 'bg-cyan-600 text-white hover:bg-cyan-500 focus-visible:ring-cyan-500/40',
        'ghost'     => 'text-slate-600 shadow-none hover:bg-slate-100 hover:text-slate-900 focus-visible:ring-slate-900/10',
        'danger'    => 'bg-red-600 text-white hover:bg-red-500 focus-visible:ring-red-500/40',
    ];
    $classes = $base.' '.($sizes[$size] ?? $sizes['md']).' '.($variants[$variant] ?? $variants['primary']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if ($icon)<x-icon :name="$icon" class="h-4 w-4" stroke="2.2" />@endif
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $classes]) }}>
        @if ($icon)<x-icon :name="$icon" class="h-4 w-4" stroke="2.2" />@endif
        {{ $slot }}
    </button>
@endif
