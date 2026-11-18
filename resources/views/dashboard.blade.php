<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Principal') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(app(\App\Services\TenantContext::class)->hasTenant())
                @php
                    $tenant = app(\App\Services\TenantContext::class)->getTenant();
                @endphp

                <div class="bg-gradient-to-r from-slate-800 to-slate-900 rounded-xl p-6 mb-6 text-white shadow-lg border-b-4 border-red-700 relative overflow-hidden">
                    <div class="relative z-10">
                        <div class="text-xs font-bold tracking-widest uppercase opacity-75 mb-1">Entorno de Trabajo Activo</div>
                        <h3 class="text-2xl font-bold mb-1">{{ $tenant->name }}</h3>
                        <div class="text-sm opacity-90">Plataforma de Control Interno y Gestión de Riesgos</div>
                        <div class="mt-4">
                            <span class="inline-block bg-white/20 border border-white/30 px-3 py-1 rounded text-xs font-bold mr-2 uppercase tracking-wide">
                                Licencia: {{ $tenant->license_type }}
                            </span>
                        </div>
                    </div>
                    <div class="absolute right-0 top-0 opacity-10 transform translate-x-1/4 -translate-y-1/4">
                        <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                </div>
                @if(auth()->user()->unreadNotifications->count() > 0)
                    <div class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-xl shadow-sm">
                        <h5 class="text-xs font-bold text-amber-800 uppercase tracking-wider mb-2">🔔 Alertas de Asignación Pendientes</h5>
                        <div class="space-y-2">
                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <div class="flex justify-between items-center text-sm text-amber-900 bg-white/60 p-2 rounded border border-amber-100">
                                    <div class="flex items-center gap-2">
                                        <span>{{ $notification->data['icono'] }}</span>
                                        <span>{{ $notification->data['mensaje'] }}</span>
                                    </div>
                                    <span class="text-[10px] text-gray-400 font-bold">{{ $notification->data['fecha'] }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-2 text-right">
                            <form method="POST" action="{{ route('notifications.read') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-amber-700 hover:underline">✓ Marcar todas como leídas</button>
                            </form>
                        </div>
                    </div>
                @endif

                <h4 class="text-sm font-bold text-gray-600 uppercase tracking-wider mb-3">Módulos del Sistema</h4>
                <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
                    <a href="{{ route('areas.index') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all border-l-4 border-slate-700 group">
                        <div class="text-2xl mb-1 group-hover:scale-110 transition-transform origin-left">🏢</div>
                        <div class="font-bold text-gray-800 text-sm">Áreas</div>
                        <div class="text-xs text-gray-500 mt-1">Estructura</div>
                    </a>
                    
                    <a href="{{ route('processes.index') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all border-l-4 border-blue-600 group">
                        <div class="text-2xl mb-1 group-hover:scale-110 transition-transform origin-left">⚙️</div>
                        <div class="font-bold text-gray-800 text-sm">Procesos</div>
                        <div class="text-xs text-gray-500 mt-1">Operaciones</div>
                    </a>

                    <a href="{{ route('risks.index') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all border-l-4 border-red-600 group">
                        <div class="text-2xl mb-1 group-hover:scale-110 transition-transform origin-left">⚠</div>
                        <div class="font-bold text-gray-800 text-sm">Riesgos</div>
                        <div class="text-xs text-gray-500 mt-1">Eventos</div>
                    </a>

                    <a href="{{ route('controls.index') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all border-l-4 border-emerald-600 group">
                        <div class="text-2xl mb-1 group-hover:scale-110 transition-transform origin-left">🛡️</div>
                        <div class="font-bold text-gray-800 text-sm">Controles</div>
                        <div class="text-xs text-gray-500 mt-1">Mitigación</div>
                    </a>

                    <a href="{{ route('matrix.dashboard') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all border-l-4 border-amber-500 group">
                        <div class="text-2xl mb-1 group-hover:scale-110 transition-transform origin-left">🗺️</div>
                        <div class="font-bold text-gray-800 text-sm">Matriz</div>
                        <div class="text-xs text-gray-500 mt-1">Mapas de calor</div>
                    </a>

                    <a href="{{ route('tenant-users.index') }}" class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all border-l-4 border-purple-600 group">
                        <div class="text-2xl mb-1 group-hover:scale-110 transition-transform origin-left">👥</div>
                        <div class="font-bold text-gray-800 text-sm">Accesos</div>
                        <div class="text-xs text-gray-500 mt-1">Usuarios a Áreas</div>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                            <span class="text-indigo-600">🔐</span>
                            <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Tus Roles en esta Empresa</h4>
                        </div>
                        <ul class="space-y-2">
                            @forelse(auth()->user()->roles as $role)
                                <li class="flex items-center text-sm text-gray-700">
                                    <span class="w-2 h-2 bg-indigo-500 rounded-full mr-2"></span>
                                    {{ $role->name }}
                                </li>
                            @empty
                                <li class="text-gray-500 italic text-sm bg-gray-50 p-2 rounded">Sin roles asignados.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="bg-white p-5 rounded-lg border border-gray-200 shadow-sm">
                        <div class="flex items-center gap-2 mb-4 pb-2 border-b border-gray-100">
                            <span class="text-emerald-600">✓</span>
                            <h4 class="font-bold text-gray-800 text-sm uppercase tracking-wide">Permisos Efectivos</h4>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @forelse(auth()->user()->getAllPermissions() as $permission)
                                <span class="bg-gray-100 border border-gray-200 text-gray-700 px-2 py-1 rounded text-xs font-medium">
                                    {{ $permission->name }}
                                </span>
                            @empty
                                <span class="text-gray-500 italic text-sm bg-gray-50 p-2 rounded block w-full">Aún no hay permisos asignados.</span>
                            @endforelse
                        </div>
                    </div>
                </div>

            @else
                <div class="max-w-lg mx-auto bg-white border border-gray-200 rounded-xl p-8 text-center shadow-sm mt-10">
                    <div class="mx-auto w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-1">Ningún contexto activo</h3>
                    <p class="text-sm text-gray-500 mb-6">Para visualizar los módulos y dashboards, selecciona una empresa desde el menú superior derecho.</p>
                    <div class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-gray-50">
                        👆 Usa el selector de arriba
                    </div>
                </div>
            @endif

            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-white border border-red-200 rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest hover:bg-red-50 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>