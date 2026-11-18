@props(['type' => 'success', 'dismissible' => false])

@php
    $styles = [
        'success' => ['box' => 'border-emerald-200 bg-emerald-50 text-emerald-800', 'icon' => 'text-emerald-500', 'path' => '<circle cx="12" cy="12" r="9"/><path d="m8.5 12 2.5 2.5 4.5-5"/>'],
        'warning' => ['box' => 'border-amber-200 bg-amber-50 text-amber-800',       'icon' => 'text-amber-500',   'path' => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/>'],
        'error'   => ['box' => 'border-red-200 bg-red-50 text-red-800',             'icon' => 'text-red-500',     'path' => '<circle cx="12" cy="12" r="9"/><path d="M12 8v4"/><path d="M12 16h.01"/>'],
        'info'    => ['box' => 'border-cyan-200 bg-cyan-50 text-cyan-900',          'icon' => 'text-cyan-600',    'path' => '<circle cx="12" cy="12" r="9"/><path d="M12 16v-4"/><path d="M12 8h.01"/>'],
    ];
    $s = $styles[$type] ?? $styles['info'];
@endphp

<div @if($dismissible) x-data="{ show: true }" x-show="show" x-transition.opacity.duration.200ms @endif
     role="{{ $type === 'error' ? 'alert' : 'status' }}"
     {{ $attributes->merge(['class' => 'flex items-start gap-3 rounded-xl border px-4 py-3 text-sm '.$s['box']]) }}>
    <svg class="mt-0.5 h-5 w-5 shrink-0 {{ $s['icon'] }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $s['path'] !!}</svg>
    <div class="min-w-0 flex-1 font-medium">{{ $slot }}</div>
    @if ($dismissible)
        <button type="button" @click="show = false" class="-m-1 rounded-md p-1 opacity-60 transition hover:opacity-100" aria-label="Cerrar mensaje">
            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
    @endif
</div>
