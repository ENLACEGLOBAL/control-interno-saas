<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') · {{ config('app.name', 'Control Interno') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css'])
</head>
<body class="relative flex min-h-full items-center justify-center overflow-hidden bg-slate-900 px-6 py-16 font-sans antialiased">
    <div class="pointer-events-none absolute inset-0"
         style="background:
            radial-gradient(1200px 600px at 10% -10%, rgba(56,189,248,.18), transparent 60%),
            radial-gradient(900px 500px at 90% 110%, rgba(99,102,241,.22), transparent 60%),
            linear-gradient(160deg, #0b1220 0%, #0f172a 60%, #111827 100%);"></div>
    <div class="pointer-events-none absolute inset-0 opacity-[0.07]"
         style="background-image:linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 42px 42px;"></div>

    <main class="relative z-10 w-full max-w-md text-center">
        <div class="mx-auto mb-8 flex h-12 w-12 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/20">
            <svg class="h-6 w-6 text-cyan-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/></svg>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-xl">
            <p class="text-sm font-bold uppercase tracking-widest text-cyan-600">Error @yield('code')</p>
            <h1 class="mt-2 text-2xl font-bold tracking-tight text-slate-900">@yield('heading')</h1>
            <p class="mt-3 text-sm leading-relaxed text-slate-500">@yield('message')</p>

            <div class="mt-8 flex flex-col-reverse gap-3 sm:flex-row sm:justify-center">
                <button type="button" onclick="history.length > 1 ? history.back() : location.href='{{ url('/') }}'"
                        class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                    Regresar
                </button>
                <a href="{{ url('/') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                    Ir al inicio
                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                </a>
            </div>
        </div>

        <p class="mt-6 text-xs text-slate-400">{{ config('app.name', 'Control Interno') }} · Gobierno, riesgo y control</p>
    </main>
</body>
</html>
