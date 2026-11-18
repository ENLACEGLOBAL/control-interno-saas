<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Centro de comando SaaS" subtitle="Administración global de tenants y usuarios" />
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

            {{-- Métricas --}}
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div class="relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-sm">
                    <div class="pointer-events-none absolute inset-0 opacity-90" style="background:radial-gradient(700px 300px at 10% -20%,rgba(56,189,248,.18),transparent 60%),linear-gradient(160deg,#0b1220,#0f172a);"></div>
                    <div class="relative z-10 flex items-center justify-between">
                        <div>
                            <h3 class="mb-1 text-sm font-semibold uppercase tracking-wider text-cyan-300/80">Total empresas (tenants)</h3>
                            <div class="text-4xl font-bold">{{ $tenants->count() }}</div>
                        </div>
                        <svg class="h-14 w-14 text-white/20" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="mb-1 text-sm font-semibold uppercase tracking-wider text-slate-500">Total usuarios globales</h3>
                            <div class="text-4xl font-bold text-slate-900">{{ $users->count() }}</div>
                        </div>
                        <svg class="h-14 w-14 text-slate-200" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
                {{-- Empresas --}}
                <x-card padding="p-0">
                    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-700">Directorio de empresas</h3>
                        <x-btn :href="route('saas.tenants.create')" variant="accent" class="!px-3 !py-1.5 text-xs">+ Nueva empresa</x-btn>
                    </div>
                    <div class="max-h-96 overflow-y-auto p-4">
                        <ul class="space-y-2">
                            @forelse($tenants as $tenant)
                            <li class="flex items-center justify-between rounded-lg border border-slate-100 p-3 transition hover:bg-slate-50">
                                <div>
                                    <div class="font-semibold text-slate-900">{{ $tenant->name }}</div>
                                    <div class="mt-0.5 font-mono text-[10px] text-slate-400">ID base: {{ $tenant->id }}</div>
                                </div>
                            </li>
                            @empty
                            <div class="py-4 text-center text-sm font-medium text-slate-400">No hay empresas registradas.</div>
                            @endforelse
                        </ul>
                    </div>
                </x-card>

                {{-- Usuarios --}}
                <x-card padding="p-0">
                    <div class="flex items-center justify-between border-b border-slate-100 px-5 py-4">
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-700">Base de usuarios</h3>
                        <x-btn :href="route('saas.users.create')" class="!px-3 !py-1.5 text-xs">+ Nuevo usuario</x-btn>
                    </div>
                    <div class="max-h-96 overflow-y-auto p-4">
                        <ul class="divide-y divide-slate-100">
                            @forelse($users as $user)
                            <li class="flex items-center justify-between py-3">
                                <div>
                                    <div class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                                        {{ $user->name }}
                                        @if($user->is_superadmin) <span class="rounded border border-amber-200 bg-amber-100 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wider text-amber-800">Root</span> @endif
                                    </div>
                                    <div class="text-xs text-slate-500">{{ $user->email }}</div>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400">Activo</span>
                            </li>
                            @empty
                            <div class="py-4 text-center text-sm font-medium text-slate-400">No hay usuarios registrados.</div>
                            @endforelse
                        </ul>
                    </div>
                </x-card>

                {{-- Roles --}}
                <x-card class="lg:col-span-2">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-700">Ingeniería de seguridad</h3>
                            <p class="text-xs text-slate-500">Configura la matriz de control de acceso basada en roles (RBAC).</p>
                        </div>
                        <x-btn :href="route('saas.roles.index')">Gestor de roles y permisos</x-btn>
                    </div>
                </x-card>
            </div>
        </div>
    </div>
</x-app-layout>
