@props([
    'name',
    'label',
    'type' => 'text',
    'icon' => null,
    'value' => '',
    'placeholder' => '',
    'autofocus' => false,
    'autocomplete' => null,
    'required' => true,
])

@php
    $icons = [
        'user'  => '<path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>',
        'mail'  => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/>',
        'lock'  => '<rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/>',
    ];
    $iconPath = $icon ? ($icons[$icon] ?? null) : null;
@endphp

<div>
    <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-slate-700">{{ $label }}</label>
    <div class="relative">
        @if ($iconPath)
            <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-slate-400">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $iconPath !!}</svg>
            </span>
        @endif
        <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}"
               value="{{ old($name, $value) }}"
               placeholder="{{ $placeholder }}"
               @if($autofocus) autofocus @endif
               @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
               @if($required) required @endif
               class="block w-full rounded-lg border border-slate-300 bg-white py-2.5 {{ $iconPath ? 'pl-10' : 'pl-3' }} pr-3 text-sm text-slate-900 placeholder-slate-400 shadow-sm transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10 focus:outline-none">
    </div>
    @error($name)
        <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>
