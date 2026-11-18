<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' · ' : '' }}{{ config('app.name', 'Control Interno') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-slate-900 antialiased">
    <div class="min-h-screen lg:grid lg:grid-cols-2">

        {{-- Panel de marca --}}
        <aside class="relative hidden overflow-hidden bg-slate-900 lg:flex lg:flex-col lg:justify-between lg:p-12">
            <div class="pointer-events-none absolute inset-0 opacity-90"
                 style="background:
                    radial-gradient(1200px 600px at 10% -10%, rgba(56,189,248,.18), transparent 60%),
                    radial-gradient(900px 500px at 90% 110%, rgba(99,102,241,.22), transparent 60%),
                    linear-gradient(160deg, #0b1220 0%, #0f172a 60%, #111827 100%);"></div>
            <div class="pointer-events-none absolute inset-0 opacity-[0.07]"
                 style="background-image:linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 42px 42px;"></div>

            <div class="relative z-10 flex items-center gap-3 text-white">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-white/10 ring-1 ring-white/20 backdrop-blur">
                    <svg class="h-6 w-6 text-cyan-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/>
                        <path d="M9 12l2 2 4-4"/>
                    </svg>
                </div>
                <span class="text-lg font-semibold tracking-tight">{{ config('app.name', 'Control Interno') }}</span>
            </div>

            <div class="relative z-10 max-w-md text-white">
                <h1 class="text-4xl font-bold leading-tight tracking-tight">
                    Gobierno, riesgo y control en un solo lugar.
                </h1>
                <p class="mt-4 text-base leading-relaxed text-slate-300">
                    Gestiona matrices COSO, evalúa riesgos y monitorea tus controles con una
                    plataforma pensada para equipos de auditoría y control interno.
                </p>

                <ul class="mt-8 space-y-4 text-sm text-slate-200">
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-cyan-400/15 text-cyan-300">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        </span>
                        Mapas de calor de riesgos en tiempo real
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-cyan-400/15 text-cyan-300">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        </span>
                        Trazabilidad de controles por área y proceso
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center rounded-md bg-cyan-400/15 text-cyan-300">
                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                        </span>
                        Roles, permisos y auditoría de accesos
                    </li>
                </ul>
            </div>

            <p class="relative z-10 text-xs text-slate-400">
                © {{ date('Y') }} {{ config('app.name', 'Control Interno') }}. Todos los derechos reservados.
            </p>
        </aside>

        {{-- Panel de contenido --}}
        <main class="flex min-h-screen items-center justify-center bg-slate-50 px-6 py-12 lg:min-h-0">
            <div class="w-full max-w-md">

                {{-- Logo compacto (visible en móvil) --}}
                <div class="mb-8 flex items-center gap-3 lg:hidden">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-900">
                        <svg class="h-5 w-5 text-cyan-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/>
                            <path d="M9 12l2 2 4-4"/>
                        </svg>
                    </div>
                    <span class="text-lg font-semibold tracking-tight text-slate-900">{{ config('app.name', 'Control Interno') }}</span>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">
                    @if (isset($heading) || isset($subheading))
                        <div class="mb-7">
                            @isset($heading)
                                <h2 class="text-2xl font-bold tracking-tight text-slate-900">{{ $heading }}</h2>
                            @endisset
                            @isset($subheading)
                                <p class="mt-1 text-sm text-slate-500">{{ $subheading }}</p>
                            @endisset
                        </div>
                    @endif

                    {{ $slot }}
                </div>

                <p class="mt-6 text-center text-xs text-slate-400">
                    Acceso seguro · Conexión cifrada
                </p>
            </div>
        </main>
    </div>
</body>
</html>
