@props(['icon' => 'inbox', 'title', 'description' => null])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center px-6 py-14 text-center']) }}>
    <span class="mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 text-slate-400 ring-8 ring-slate-50">
        <x-icon :name="$icon" class="h-6 w-6" />
    </span>
    <h3 class="text-base font-semibold text-slate-900">{{ $title }}</h3>
    @if ($description)
        <p class="mt-1 max-w-sm text-sm text-slate-500">{{ $description }}</p>
    @endif
    @if (trim($slot))
        <div class="mt-5 flex flex-wrap justify-center gap-2">{{ $slot }}</div>
    @endif
</div>
