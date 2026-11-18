@props(['title' => null, 'subtitle' => null, 'padding' => 'p-6'])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-slate-200/80 bg-white shadow-sm shadow-slate-900/[0.03]']) }}>
    @if ($title)
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-6 py-4">
            <div>
                <h3 class="text-sm font-semibold text-slate-900">{{ $title }}</h3>
                @if ($subtitle)
                    <p class="mt-0.5 text-xs text-slate-500">{{ $subtitle }}</p>
                @endif
            </div>
            @isset($actions)
                <div class="flex items-center gap-2">{{ $actions }}</div>
            @endisset
        </div>
    @endif
    <div class="{{ $padding }}">{{ $slot }}</div>
</div>
