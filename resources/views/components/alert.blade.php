@props(['type' => 'success'])

@php
    $styles = [
        'success' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
        'warning' => 'border-amber-200 bg-amber-50 text-amber-700',
        'error'   => 'border-red-200 bg-red-50 text-red-700',
        'info'    => 'border-slate-200 bg-slate-50 text-slate-700',
    ];
@endphp

<div {{ $attributes->merge(['class' => 'rounded-lg border px-4 py-3 text-sm font-medium '.($styles[$type] ?? $styles['info'])]) }}>
    {{ $slot }}
</div>
