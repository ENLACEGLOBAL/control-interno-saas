<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $crumbs = \App\Support\Navigation::breadcrumbs();
            $pageTitle = count($crumbs) > 1 ? end($crumbs)['label'] : 'Inicio';
        @endphp
        <title>{{ $pageTitle }} · {{ config('app.name', 'Control Interno') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('head')
    </head>
    <body class="h-full bg-slate-50 font-sans text-slate-900 antialiased" x-data="{ sidebarOpen: false }" @keydown.escape.window="sidebarOpen = false">

        <a href="#contenido" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-[60] focus:rounded-lg focus:bg-slate-900 focus:px-4 focus:py-2 focus:text-sm focus:font-semibold focus:text-white">
            Saltar al contenido
        </a>

        {{-- Barra lateral: escritorio fija, móvil como panel deslizable --}}
        <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-40 bg-slate-950/60 backdrop-blur-sm lg:hidden"
             x-transition.opacity @click="sidebarOpen = false"></div>

        <aside class="fixed inset-y-0 left-0 z-50 flex w-72 -translate-x-full flex-col transition-transform duration-300 ease-out lg:translate-x-0"
               :class="{ 'translate-x-0': sidebarOpen, '-translate-x-full': !sidebarOpen }"
               aria-label="Navegación principal">
            @include('layouts.sidebar')
        </aside>

        {{-- Zona de contenido --}}
        <div class="flex min-h-full flex-col lg:pl-72">
            @include('layouts.topbar', ['crumbs' => $crumbs])

            <main id="contenido" class="flex-1">
                {{-- Mensajes globales del sistema --}}
                @php
                    $internalStatuses = ['profile-updated', 'password-updated', 'verification-link-sent'];
                    $status = session('status');
                @endphp
                @if (($status && ! in_array($status, $internalStatuses)) || session('error'))
                    <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                        @if ($status && ! in_array($status, $internalStatuses))
                            <x-alert type="success" dismissible>{{ $status }}</x-alert>
                        @endif
                        @if (session('error'))
                            <x-alert type="error" dismissible>{{ session('error') }}</x-alert>
                        @endif
                    </div>
                @endif

                @isset($header)
                    <div class="mx-auto max-w-7xl px-4 pt-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                @endisset

                {{ $slot }}
            </main>

            <footer class="border-t border-slate-200/70">
                <div class="mx-auto flex max-w-7xl flex-col gap-1 px-4 py-5 text-xs text-slate-400 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">
                    <span>© {{ date('Y') }} {{ config('app.name', 'Control Interno') }} · Gobierno, riesgo y control</span>
                    <span class="flex items-center gap-1.5">
                        <x-icon name="lock" class="h-3.5 w-3.5" />
                        Sesión segura · Conexión cifrada
                    </span>
                </div>
            </footer>
        </div>
    </body>
</html>
