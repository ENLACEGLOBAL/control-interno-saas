@props(['title', 'subtitle' => null, 'icon' => null])

<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div class="flex min-w-0 items-center gap-4">
        @if ($icon)
            <span class="hidden h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-900 text-cyan-300 shadow-sm ring-1 ring-slate-900/5 sm:flex">
                <x-icon :name="$icon" class="h-6 w-6" />
            </span>
        @endif
        <div class="min-w-0">
            <h1 class="truncate text-2xl font-bold tracking-tight text-slate-900">{{ $title }}</h1>
            @if ($subtitle)
                <p class="mt-1 text-sm text-slate-500">{{ $subtitle }}</p>
            @endif
        </div>
    </div>
    @isset($actions)
        <div class="flex shrink-0 flex-wrap items-center gap-2">
            {{ $actions }}
        </div>
    @endisset
</div>
