@props(['step' => null, 'title', 'description' => null])

<div {{ $attributes->merge(['class' => 'grid grid-cols-1 gap-x-8 gap-y-4 lg:grid-cols-3']) }}>
    <div>
        <h3 class="flex items-center gap-2 text-sm font-semibold text-slate-900">
            @if ($step)
                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-slate-900 text-[11px] font-bold text-cyan-300">{{ $step }}</span>
            @endif
            {{ $title }}
        </h3>
        @if ($description)
            <p class="mt-1 text-sm text-slate-500">{{ $description }}</p>
        @endif
    </div>
    <div class="space-y-5 lg:col-span-2">
        {{ $slot }}
    </div>
</div>
