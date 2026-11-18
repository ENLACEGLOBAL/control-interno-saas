<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Centro de comando SaaS" subtitle="Administración global de empresas, usuarios y seguridad" icon="crown">
            <x-slot name="actions">
                <x-btn :href="route('saas.users.create')" variant="secondary" icon="plus">Usuario</x-btn>
                <x-btn :href="route('saas.tenants.create')" icon="plus">Empresa</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 pb-12 pt-6 sm:px-6 lg:px-8">

        {{-- Métricas --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
            <div class="relative overflow-hidden rounded-2xl bg-slate-900 p-6 text-white shadow-sm">
                <div class="pointer-events-none absolute inset-0" style="background:radial-gradient(500px 240px at 0% -20%,rgba(56,189,248,.22),transparent 60%),linear-gradient(160deg,#0b1220,#0f172a);"></div>
                <div class="relative z-10 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-cyan-300/90">Empresas</p>
                        <p class="mt-1 text-4xl font-bold">{{ $tenants->count() }}</p>
                    </div>
                    <x-icon name="building" class="h-12 w-12 text-white/15" stroke="1.4" />
                </div>
            </div>
            <div class="rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Usuarios globales</p>
                        <p class="mt-1 text-4xl font-bold text-slate-900">{{ $users->count() }}</p>
                    </div>
                    <x-icon name="users" class="h-12 w-12 text-slate-200" stroke="1.4" />
                </div>
            </div>
            <a href="{{ route('saas.roles.index') }}" class="group rounded-2xl border border-slate-200/80 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-slate-300 hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-widest text-slate-400">Seguridad RBAC</p>
                        <p class="mt-1 text-lg font-bold text-slate-900">Roles y permisos</p>
                        <p class="mt-0.5 inline-flex items-center gap-1 text-xs font-semibold text-cyan-700">Abrir gestor <x-icon name="chevron" class="h-3.5 w-3.5 transition group-hover:translate-x-0.5" stroke="2" /></p>
                    </div>
                    <x-icon name="key" class="h-12 w-12 text-slate-200" stroke="1.4" />
                </div>
            </a>
        </div>

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
            {{-- Empresas --}}
            <x-card title="Directorio de empresas" subtitle="Tenants activos en la plataforma" padding="p-0">
                <x-slot name="actions">
                    <x-btn :href="route('saas.tenants.create')" variant="accent" size="sm" icon="plus">Nueva</x-btn>
                </x-slot>
                <ul class="max-h-[26rem] divide-y divide-slate-100 overflow-y-auto">
                    @forelse ($tenants as $tenant)
                        <li class="flex items-center gap-3 px-6 py-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-lg bg-slate-100 text-slate-500"><x-icon name="building" class="h-4 w-4" /></span>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-semibold text-slate-900">{{ $tenant->name }}</p>
                                <p class="font-mono text-[11px] text-slate-400">ID {{ $tenant->id }}</p>
                            </div>
                            @if ($tenant->license_type)
                                <span class="rounded-full bg-slate-100 px-2.5 py-0.5 text-[11px] font-semibold text-slate-600">{{ $tenant->license_type }}</span>
                            @endif
                        </li>
                    @empty
                        <li><x-empty-state icon="building" title="Sin empresas" description="Registra la primera empresa cliente." /></li>
                    @endforelse
                </ul>
            </x-card>

            {{-- Usuarios --}}
            <x-card title="Base de usuarios" subtitle="Cuentas con acceso a la plataforma" padding="p-0">
                <x-slot name="actions">
                    <x-btn :href="route('saas.users.create')" size="sm" icon="plus">Nuevo</x-btn>
                </x-slot>
                <ul class="max-h-[26rem] divide-y divide-slate-100 overflow-y-auto">
                    @forelse ($users as $user)
                        <li class="flex items-center gap-3 px-6 py-3">
                            <span class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-900 text-xs font-bold text-white">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                            <div class="min-w-0 flex-1">
                                <p class="flex items-center gap-2 truncate text-sm font-semibold text-slate-900">
                                    {{ $user->name }}
                                    @if ($user->is_superadmin)
                                        <span class="rounded bg-amber-100 px-1.5 py-0.5 text-[9px] font-bold uppercase tracking-wider text-amber-800">Root</span>
                                    @endif
                                </p>
                                <p class="truncate text-xs text-slate-500">{{ $user->email }}</p>
                            </div>
                            <span class="flex items-center gap-1 text-[11px] font-medium text-emerald-600"><span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>Activo</span>
                        </li>
                    @empty
                        <li><x-empty-state icon="users" title="Sin usuarios" description="Da de alta el primer usuario." /></li>
                    @endforelse
                </ul>
            </x-card>
        </div>
    </div>
</x-app-layout>
