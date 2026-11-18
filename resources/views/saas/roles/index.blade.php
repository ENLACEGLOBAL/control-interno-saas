<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Matriz maestra de roles y permisos" subtitle="Gestión RBAC de la plataforma">
            <x-slot name="actions">
                <x-btn :href="route('saas.dashboard')" variant="secondary">Volver al dashboard</x-btn>
            </x-slot>
        </x-page-header>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 space-y-8">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <x-card>
                    <h3 class="mb-4 text-sm font-semibold uppercase text-slate-700">1. Crear nuevo permiso (código)</h3>
                    <form method="POST" action="{{ route('saas.permissions.store') }}" class="flex gap-2">
                        @csrf
                        <x-text-input type="text" name="name" required placeholder="ej: crear_riesgos, editar_controles..." class="flex-1 text-sm" />
                        <x-btn>Añadir</x-btn>
                    </form>
                    <p class="mt-2 text-[11px] text-slate-400">Este nombre es el que usarás en el código (ej: <span class="font-mono text-cyan-600">@can('crear_riesgos')</span>)</p>
                </x-card>

                <x-card>
                    <h3 class="mb-4 text-sm font-semibold uppercase text-slate-700">2. Crear nuevo rol organizacional</h3>
                    <form method="POST" action="{{ route('saas.roles.store') }}" class="flex gap-2">
                        @csrf
                        <x-text-input type="text" name="name" required placeholder="ej: auditor_externo, gerente..." class="flex-1 text-sm" />
                        <x-btn variant="accent">Crear rol</x-btn>
                    </form>
                    <p class="mt-2 text-[11px] text-slate-400">El rol agrupa múltiples permisos. A los usuarios se les asignan roles, no permisos sueltos.</p>
                </x-card>
            </div>

            <x-card padding="p-0">
                <div class="border-b border-slate-100 bg-slate-50 px-5 py-4">
                    <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-700">3. Matriz de vinculación (role-permission sync)</h3>
                </div>
                <div class="p-6">
                    @if($permissions->isEmpty())
                        <div class="py-4 text-center font-semibold text-red-500">Aún no has creado ningún permiso en el sistema.</div>
                    @else
                        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                            @foreach($roles as $role)
                                <form method="POST" action="{{ route('saas.roles.permissions.sync', $role->id) }}" class="rounded-xl border border-slate-200 bg-slate-50 p-4">
                                    @csrf
                                    <div class="mb-4 flex items-center justify-between border-b border-slate-200 pb-2">
                                        <h4 class="text-base font-bold uppercase text-slate-900">Rol: {{ str_replace('_', ' ', $role->name) }}</h4>
                                        <button type="submit" class="rounded-full border border-cyan-200 bg-cyan-50 px-3 py-1 text-[10px] font-bold uppercase tracking-wider text-cyan-700 transition hover:bg-cyan-600 hover:text-white">
                                            Guardar matriz
                                        </button>
                                    </div>
                                    <div class="grid max-h-60 grid-cols-2 gap-2 overflow-y-auto">
                                        @foreach($permissions as $permission)
                                            <label class="flex cursor-pointer items-start rounded border border-transparent p-1.5 text-xs font-medium text-slate-700 transition hover:border-slate-200 hover:bg-white">
                                                <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                                    {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}
                                                    class="mr-2 mt-0.5 h-3.5 w-3.5 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20">
                                                <span class="font-mono text-slate-600">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    @endif
                </div>
            </x-card>

        </div>
    </div>
</x-app-layout>
