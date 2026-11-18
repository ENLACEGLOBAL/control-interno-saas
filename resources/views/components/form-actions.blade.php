@props(['cancel' => null, 'cancelLabel' => 'Cancelar'])

<div {{ $attributes->merge(['class' => 'flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:items-center sm:justify-end']) }}>
    @if ($cancel)
        <x-btn :href="$cancel" variant="secondary">{{ $cancelLabel }}</x-btn>
    @endif
    {{ $slot }}
</div>
