<select {{ $attributes->merge(['class' => 'block w-full rounded-lg border-slate-300 text-sm text-slate-900 shadow-sm transition focus:border-slate-900 focus:ring-2 focus:ring-slate-900/10']) }}>
    {{ $slot }}
</select>
