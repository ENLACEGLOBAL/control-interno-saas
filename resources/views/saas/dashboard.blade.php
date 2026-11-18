<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-900 leading-tight flex items-center gap-2">
            👑 <span class="uppercase tracking-wider font-black">Centro de Comando SaaS</span>
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-gradient-to-br from-indigo-600 to-indigo-800 rounded-xl shadow-lg p-6 text-white flex justify-between items-center">
                    <div>
                        <h3 class="text-indigo-100 text-sm font-bold uppercase tracking-wider mb-1">Total Empresas (Tenants)</h3>
                        <div class="text-4xl font-black">{{ $tenants->count() }}</div>
                    </div>
                    <div class="text-indigo-300 opacity-50"><svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg></div>
                </div>

                <div class="bg-gradient-to-br from-slate-700 to-slate-900 rounded-xl shadow-lg p-6 text-white flex justify-between items-center">
                    <div>
                        <h3 class="text-slate-300 text-sm font-bold uppercase tracking-wider mb-1">Total Usuarios Globales</h3>
                        <div class="text-4xl font-black">{{ $users->count() }}</div>
                    </div>
                    <div class="text-slate-500 opacity-50"><svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg></div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 uppercase tracking-wider text-sm">🏢 Directorio de Empresas</h3>
                        <a href="{{ route('saas.tenants.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-1 px-3 rounded text-xs shadow-sm transition-colors">+ Nueva Empresa</a>
                    </div>
                    <div class="p-4 overflow-y-auto max-h-96">
                        <ul class="space-y-3">
                            @forelse($tenants as $tenant)
                            <li class="p-3 border border-gray-100 rounded-lg hover:bg-indigo-50 transition-colors flex justify-between items-center">
                                <div>
                                    <div class="font-bold text-indigo-900">{{ $tenant->name }}</div>
                                    <div class="text-[10px] text-gray-400 font-mono mt-0.5">ID Base: {{ $tenant->id }}</div>
                                </div>
                            </li>
                            @empty
                            <div class="text-center text-gray-400 py-4 text-sm font-medium">No hay empresas registradas.</div>
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="p-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-700 uppercase tracking-wider text-sm">👥 Base de Usuarios</h3>
                        <a href="{{ route('saas.users.create') }}" class="bg-slate-800 hover:bg-slate-700 text-white font-bold py-1 px-3 rounded text-xs shadow-sm transition-colors">+ Nuevo Usuario</a>
                    </div>
                    <div class="p-4 overflow-y-auto max-h-96">
                        <ul class="divide-y divide-gray-100">
                            @forelse($users as $user)
                            <li class="py-3 flex justify-between items-center">
                                <div>
                                    <div class="font-bold text-gray-800 text-sm flex items-center gap-2">
                                        {{ $user->name }}
                                        @if($user->is_superadmin) <span class="text-[9px] bg-yellow-100 text-yellow-800 px-1.5 py-0.5 rounded font-black uppercase tracking-wider border border-yellow-200">👑 Root</span> @endif
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] text-gray-400 font-bold">Activo</span>
                                </div>
                            </li>
                            @empty
                            <div class="text-center text-gray-400 py-4 text-sm font-medium">No hay usuarios registrados.</div>
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-800 uppercase tracking-wider text-sm">Ingeniería de Seguridad</h3>
                        <p class="text-xs text-gray-500">Configura la matriz de control de acceso basada en roles (RBAC).</p>
                    </div>
                    <a href="{{ route('saas.roles.index') }}" class="bg-slate-800 hover:bg-slate-700 text-white font-bold py-2 px-6 rounded shadow-sm transition-colors text-sm flex items-center gap-2">
                        🛡️ Gestor de Roles y Permisos
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>