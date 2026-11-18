<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Panel principal" subtitle="Resumen de tu entorno de control interno" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            @if(app(\App\Services\TenantContext::class)->hasTenant())
                @php
                    $tenant = app(\App\Services\TenantContext::class)->getTenant();
                @endphp

                {{-- Banner de entorno activo --}}
                <div class="relative mb-6 overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-sm">
                    <div class="pointer-events-none absolute inset-0 opacity-90"
                         style="background:
                            radial-gradient(900px 400px at 15% -20%, rgba(56,189,248,.18), transparent 60%),
                            radial-gradient(700px 400px at 95% 120%, rgba(99,102,241,.20), transparent 60%),
                            linear-gradient(160deg,#0b1220 0%,#0f172a 60%,#111827 100%);"></div>
                    <div class="relative z-10">
                        <div class="mb-1 text-xs font-semibold uppercase tracking-widest text-cyan-300/80">Entorno de trabajo activo</div>
                        <h3 class="text-2xl font-bold">{{ $tenant->name }}</h3>
                        <div class="mt-1 text-sm text-slate-300">Plataforma de Control Interno y Gestión de Riesgos</div>
                        <div class="mt-4">
                            <span class="inline-block rounded-md border border-white/20 bg-white/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide">
                                Licencia: {{ $tenant->license_type }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Notificaciones --}}
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <x-card class="mb-6 border-l-4 border-l-amber-400" padding="p-5">
                        <h5 class="mb-3 text-xs font-bold uppercase tracking-wider text-amber-700">Alertas de asignación pendientes</h5>
                        <div class="space-y-2">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <div class="flex items-center justify-between rounded-lg border border-amber-100 bg-amber-50/60 p-2 text-sm text-amber-900">
                                    <div class="flex items-center gap-2">
                                        <span>{{ $notification->data['icono'] }}</span>
                                        <span>{{ $notification->data['mensaje'] }}</span>
                                    </div>
                                    <span class="text-[10px] font-bold text-slate-400">{{ $notification->data['fecha'] }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-3 text-right">
                            <form method="POST" action="{{ route('notifications.read') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-semibold text-amber-700 hover:underline">Marcar todas como leídas</button>
                            </form>
                        </div>
                    </x-card>
                @endif

                {{-- Módulos --}}
                <h4 class="mb-3 text-xs font-semibold uppercase tracking-wider text-slate-500">Módulos del sistema</h4>
                <div class="mb-8 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-6">
                    @php
                        $modules = [
                            ['route' => route('areas.index'),     'label' => 'Áreas',     'desc' => 'Estructura',       'accent' => 'bg-slate-100 text-slate-700',   'icon' => '<path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/>'],
                            ['route' => route('processes.index'),  'label' => 'Procesos',  'desc' => 'Operaciones',      'accent' => 'bg-blue-100 text-blue-700',     'icon' => '<circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/>'],
                            ['route' => route('risks.index'),      'label' => 'Riesgos',   'desc' => 'Eventos',          'accent' => 'bg-red-100 text-red-700',       'icon' => '<path d="M10.29 3.86 1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/><path d="M12 9v4"/><path d="M12 17h.01"/>'],
                            ['route' => route('controls.index'),   'label' => 'Controles', 'desc' => 'Mitigación',       'accent' => 'bg-emerald-100 text-emerald-700','icon' => '<path d="M12 3l7 3v5c0 4.5-3 8.2-7 10-4-1.8-7-5.5-7-10V6l7-3z"/><path d="M9 12l2 2 4-4"/>'],
                            ['route' => route('matrix.dashboard'), 'label' => 'Matriz',    'desc' => 'Mapas de calor',   'accent' => 'bg-amber-100 text-amber-700',   'icon' => '<rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>'],
                            ['route' => route('tenant-users.index'),'label' => 'Accesos',  'desc' => 'Usuarios a áreas', 'accent' => 'bg-purple-100 text-purple-700', 'icon' => '<path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>'],
                        ];
                    @endphp
                    @foreach($modules as $m)
                        <a href="{{ $m['route'] }}" class="group rounded-2xl border border-slate-200 bg-white p-4 transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                            <span class="mb-3 flex h-10 w-10 items-center justify-center rounded-lg {{ $m['accent'] }}">
                                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">{!! $m['icon'] !!}</svg>
                            </span>
                            <div class="text-sm font-semibold text-slate-900">{{ $m['label'] }}</div>
                            <div class="mt-0.5 text-xs text-slate-500">{{ $m['desc'] }}</div>
                        </a>
                    @endforeach
                </div>

                {{-- Roles y permisos --}}
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <x-card>
                        <div class="mb-4 flex items-center gap-2 border-b border-slate-100 pb-3">
                            <span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="11" width="16" height="10" rx="2"/><path d="M8 11V7a4 4 0 0 1 8 0v4"/></svg>
                            </span>
                            <h4 class="text-sm font-semibold uppercase tracking-wide text-slate-700">Tus roles en esta empresa</h4>
                        </div>
                        <ul class="space-y-2">
                            @forelse(auth()->user()->roles as $role)
                                <li class="flex items-center text-sm text-slate-700">
                                    <span class="mr-2 h-2 w-2 rounded-full bg-cyan-500"></span>
                                    {{ $role->name }}
                                </li>
                            @empty
                                <li class="rounded-lg bg-slate-50 p-2 text-sm italic text-slate-500">Sin roles asignados.</li>
                            @endforelse
                        </ul>
                    </x-card>

                    <x-card>
                        <div class="mb-4 flex items-center gap-2 border-b border-slate-100 pb-3">
                            <span class="flex h-7 w-7 items-center justify-center rounded-md bg-emerald-100 text-emerald-600">
                                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 6L9 17l-5-5"/></svg>
                            </span>
                            <h4 class="text-sm font-semibold uppercase tracking-wide text-slate-700">Permisos efectivos</h4>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @forelse(auth()->user()->getAllPermissions() as $permission)
                                <span class="rounded-md border border-slate-200 bg-slate-50 px-2 py-1 text-xs font-medium text-slate-700">
                                    {{ $permission->name }}
                                </span>
                            @empty
                                <span class="block w-full rounded-lg bg-slate-50 p-2 text-sm italic text-slate-500">Aún no hay permisos asignados.</span>
                            @endforelse
                        </div>
                    </x-card>
                </div>

            @else
                <x-card class="mx-auto mt-10 max-w-lg text-center" padding="p-8">
                    <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-slate-100">
                        <svg class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <h3 class="mb-1 text-lg font-bold text-slate-900">Ningún contexto activo</h3>
                    <p class="mb-6 text-sm text-slate-500">Para visualizar los módulos y dashboards, selecciona una empresa desde el menú superior derecho.</p>
                    <div class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-medium text-slate-700">
                        Usa el selector de arriba
                    </div>
                </x-card>
            @endif

            <div class="mt-8 flex justify-end border-t border-slate-200 pt-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-4 py-2 text-sm font-semibold text-red-600 transition hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Cerrar sesión
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
