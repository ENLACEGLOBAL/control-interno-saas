<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Roles y permisos" subtitle="Matriz maestra de control de acceso basado en roles (RBAC)" icon="key" />
    </x-slot>

    <div class="mx-auto max-w-7xl space-y-6 px-4 pb-12 pt-6 sm:px-6 lg:px-8">
        <x-form-errors />

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <x-card title="1 · Nuevo permiso" subtitle="Código que se usa en la aplicación">
                <form method="POST" action="{{ route('saas.permissions.store') }}" class="flex gap-2">
                    @csrf
                    <x-text-input type="text" name="name" required placeholder="ej: crear_riesgos" class="flex-1 font-mono" aria-label="Nombre del permiso" />
                    <x-btn icon="plus">Añadir</x-btn>
                </form>
                <p class="mt-2 text-xs text-slate-400">Se usa en el código como <span class="font-mono text-cyan-700">@@can('crear_riesgos')</span>.</p>
            </x-card>

            <x-card title="2 · Nuevo rol" subtitle="Agrupa permisos para asignarlos a usuarios">
                <form method="POST" action="{{ route('saas.roles.store') }}" class="flex gap-2">
                    @csrf
                    <x-text-input type="text" name="name" required placeholder="ej: auditor_externo" class="flex-1 font-mono" aria-label="Nombre del rol" />
                    <x-btn variant="accent" icon="plus">Crear</x-btn>
                </form>
                <p class="mt-2 text-xs text-slate-400">A los usuarios se les asignan roles, no permisos sueltos.</p>
            </x-card>
        </div>

        <x-card title="3 · Matriz de vinculación" subtitle="Marca los permisos de cada rol y guarda los cambios por rol">
            @if ($permissions->isEmpty())
                <x-empty-state icon="key" title="Aún no hay permisos" description="Crea al menos un permiso para poder asignarlo a los roles." />
            @elseif ($roles->isEmpty())
                <x-empty-state icon="users" title="Aún no hay roles" description="Crea un rol para empezar a asignarle permisos." />
            @else
                <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
                    @foreach ($roles as $role)
                        <form method="POST" action="{{ route('saas.roles.permissions.sync', $role->id) }}" class="flex flex-col rounded-xl border border-slate-200 bg-slate-50/60">
                            @csrf
                            <div class="flex items-center justify-between gap-3 border-b border-slate-200 px-4 py-3">
                                <div class="flex min-w-0 items-center gap-2">
                                    <span class="flex h-7 w-7 items-center justify-center rounded-md bg-slate-900 text-cyan-300"><x-icon name="users" class="h-4 w-4" /></span>
                                    <h4 class="truncate text-sm font-bold capitalize text-slate-900">{{ str_replace('_', ' ', $role->name) }}</h4>
                                    <span class="rounded-full bg-white px-2 py-0.5 text-[11px] font-semibold text-slate-500 ring-1 ring-slate-200">{{ $role->permissions->count() }}/{{ $permissions->count() }}</span>
                                </div>
                                <x-btn size="sm" icon="check">Guardar</x-btn>
                            </div>
                            <div class="grid max-h-60 grid-cols-1 gap-1 overflow-y-auto p-3 sm:grid-cols-2">
                                @foreach ($permissions as $permission)
                                    <label class="flex cursor-pointer items-center gap-2 rounded-lg px-2 py-1.5 text-xs transition hover:bg-white">
                                        <input type="checkbox" name="permissions[]" value="{{ $permission->name }}"
                                               @checked($role->hasPermissionTo($permission->name))
                                               class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900/20">
                                        <span class="font-mono text-slate-600">{{ $permission->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </form>
                    @endforeach
                </div>
            @endif
        </x-card>
    </div>
</x-app-layout>
